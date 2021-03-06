﻿using System.Collections;
using System.Collections.Generic;
using UnityEngine;

namespace LLAPI
{
    public class CP_NetworkObject : Network_Object
    {
        [SerializeField]
        private bool isBeingCaptured = false;

        [SerializeField]
        private float captureAmount = 5.0f;
        [SerializeField]
        private float capturePercentage = 0.0f;
        [SerializeField]
        private TextMesh tm;
        [SerializeField]
        private bool runTriggerEnter = false;
        [SerializeField]
        private bool runTriggerExit = false;
        [SerializeField]
        private bool runRecive = false;

        [SerializeField]
        private bool isServer = false;

        //has this capture point been captured
        public bool IsCaptured
        {
            get
            {
                if((int)captureAmount == 100 || capturePercentage > 99.9f)
                {
                    return true;
                }
                return false;
            }
        }

        /// <summary>
        /// Update
        /// </summary>
        private void Update()
        {
            if (tm != null)
            {
                tm.text = capturePercentage.ToString();
            }
            if (isBeingCaptured)
            {
                capturePercentage += captureAmount * Time.deltaTime;

                if (capturePercentage > 100.0f)
                {
                    capturePercentage = 100.0f;

                    if (isServer)
                    {
                        //ExitManager.Insntane.CapturePointCaptured();
                    }
                }
            }
        }

        /// <summary>
        /// Override
        /// </summary>
        /// <param name="a_netMsg"></param>
        public override void Recive(NetMsg a_netMsg)
        {
            //If this is not a server object. For the capture point we are reciving
            //if(!IsServerObject)
            //{
            //}

            if (runRecive)
            {
                NetMsg_CP_Capture cp = (NetMsg_CP_Capture)a_netMsg;

                isBeingCaptured = cp.IsBeingCaptured;
                capturePercentage = cp.Percentage;

                if (isBeingCaptured)
                {
                    GetComponent<MeshRenderer>().material.color = Color.red;
                }
                else
                {
                    GetComponent<MeshRenderer>().material.color = Color.white;
                }
            }
        }

        /// <summary>
        /// Enter trigger
        /// </summary>
        /// <param name="other"></param>
        private void OnTriggerEnter(Collider other)
        {
            if (runTriggerEnter)
            {
                if (other.tag == "Spy")
                {
                    isBeingCaptured = true;

                    GetComponent<MeshRenderer>().material.color = Color.red;

                    NetMsg_CP_Capture capture = new NetMsg_CP_Capture();
                    capture.ID = ID;
                    capture.IsBeingCaptured = isBeingCaptured;
                    capture.Percentage = (int)capturePercentage;

                    Server.Instance.Send(capture, Server.Instance.ReliableChannel);
                }
            }
        }

        /// <summary>
        /// Exit trigger
        /// </summary>
        /// <param name="other"></param>
        private void OnTriggerExit(Collider other)
        {
            if (runTriggerExit)
            {
                if (other.tag == "Spy")
                {
                    isBeingCaptured = false;

                    GetComponent<MeshRenderer>().material.color = Color.white;

                    NetMsg_CP_Capture capture = new NetMsg_CP_Capture();
                    capture.ID = ID;
                    capture.IsBeingCaptured = isBeingCaptured;
                    capture.Percentage = (int)capturePercentage;

                    Server.Instance.Send(capture, Server.Instance.ReliableChannel);
                }
            }
        }
    }
}
