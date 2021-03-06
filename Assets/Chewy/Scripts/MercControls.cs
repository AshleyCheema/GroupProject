﻿/*
 * Author: Ashley Cheema
 * Description: Player controller to controll any player. 
 * This includes basic movements features.
 * Created: 04/02/2019
 * Edited By: Ash + Ian
 */

using LLAPI;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class MercControls : PlayerController
{
    private float cooldown;
    private float speedDuration;
    public Image flashPanel;
    private Color panelColor = new Color(255, 255, 255);
    public bool canSprint;
    public bool buttonPressed;
    private TrackerAbility trackerAbility;
    public bool noShoot;
    private float shotCooldown = 1.5f;
    private float reloadSpeed = 2f;
    private GameObject bullet;
    public Trigger triggerScript;
    public GameObject firePosition;
    public GameObject laser;

    public ParticleSystem bulletEffect;

    public bool isStunned = false;
    public bool IsStunned
    { get { return isStunned; }
        set
        {
            isStunned = value;
            triggerScript.isStunned = true;
        }
    }
    private float stunCountDown = 5.0f;

    //Audio
    private AudioSource audioSource;
    public AudioSO /*Thats How You Get*/ tinnitus;

    public Abilities sprint;

    //animation last state
    private int animLastState = -1;

    // Start is called before the first frame update
    public override void Start()
    {
        base.Start();
        trackerAbility = GetComponent<TrackerAbility>();
        audioSource = gameObject.GetComponent<AudioSource>();
        flashPanel.canvasRenderer.SetAlpha(1.0f);
        cooldown = sprint.cooldown;
        canSprint = sprint.isCooldown;
        speedDuration = sprint.abilityDuration;
        bullet = GameObject.Find("Bullet");
        if (bullet != null)
        {
            bullet.SetActive(false);
        }
    }

    // Update is called once per frame
    public override void Update()
    {
        //Networking for the Merc animations
        if(animLastState != animator.GetCurrentAnimatorStateInfo(0).fullPathHash)
        {
            animLastState = animator.GetCurrentAnimatorStateInfo(0).fullPathHash;

            //send animation message
            Msg_ClientAnimChange cac = new Msg_ClientAnimChange();
            cac.hash = animLastState;
            cac.connectId = (byte)ClientManager.Instance?.LocalPlayer.connectionId;
            cac.direction = (byte)(animator.GetFloat("InputX+") + 2);
            ClientManager.Instance?.client.Send(MSGTYPE.CLIENT_ANIM_CHANGE, cac);
        }

        //UpdateDirection();
        base.Update();

        //if(Input.GetKey(KeyCode.P))
        //{
        //    sprint.Trigger();
        //}

        //ab_Fire.Trigger = triggerScript.hasShot;

        //if (triggerScript != null)
        //{
        if (triggerScript == null)
        {
            triggerScript = GameObject.Find("StunG").GetComponent<Trigger>();
        }

        //If this are true they will be their designated animation
        animator.SetBool("isBurst", buttonPressed);
        animator.SetBool("isBlinded", triggerScript.isStunned);

        //If the Merc is stunned by the Spy then they will slowed, deafened and blinded temporarily
        if (triggerScript.isStunned)
        {
            currentSpeed = reloadSpeed;
            canSprint = false;
            tinnitus.SetSourceProperties(audioSource);
            audioSource.Play();
            stunCountDown -= Time.deltaTime;
            flashPanel.gameObject.SetActive(true);
            flashPanel.CrossFadeAlpha(0.0f, stunCountDown, false);
            if (stunCountDown <= 0)
            {
                stunCountDown = 5.0f;
                currentSpeed = normalSpeed;
                triggerScript.isStunned = false;
                canSprint = true;
                flashPanel.gameObject.SetActive(false);
            }
        }

        //}

        //This if statement checks if the Spy can fire their weapon
        //It uses a raycast to detect whether it has hit the Spy
        if (Input.GetAxisRaw("MercFire") > 0.5f && !noShoot && !trackerAbility.trackerActive && !buttonPressed)
        {
            RaycastHit hit;
            //raycast
            if(Physics.Raycast(firePosition.transform.position, firePosition.transform.forward, out hit, 1 << 13))
            {
                Debug.Log(hit.collider.gameObject);
                foreach (var key in ClientManager.Instance?.Players.Keys)
                {
                    //if true we have found the gameObejct hit
                    if (hit.collider.gameObject == ClientManager.Instance.Players[key].gameAvatar)
                    {
                        Msg_ClientTrigger ct = new Msg_ClientTrigger();
                        ct.ConnectionID = key;
                        ct.Trigger = true;
                        ct.Type = TriggerType.Bullet;
                        ClientManager.Instance.client.Send(MSGTYPE.CLIENT_AB_TRIGGER, ct);
                    }
                }
            }
            
            bulletEffect.Play();
            noShoot = true;

            GetComponent<AudioEvents>().PlayFireSound();
            //if (fireSound != null)
            //{
            //    fireSound.SetSourceProperties(audioSource);
            //    audioSource.Play();
            //}

            PlayerStats.Instance.ShotsFired++;
            PlayerStats.Instance.AbililitesUsed++;

            #region NetMsg_Fire
            Msg_AB_ClientFire ab_Fire = new Msg_AB_ClientFire();
            if (ClientManager.Instance != null)
            {
                ab_Fire.ConnectId = ClientManager.Instance.LocalPlayer.connectionId;

                ab_Fire.BulletPosition = bullet.transform.position;

                ab_Fire.BulletVelocity = bullet.GetComponent<Rigidbody>().velocity;

                ab_Fire.BulletObjectIndex = 2;
                ClientManager.Instance.client.Send(MSGTYPE.CLIENT_AB_FIRE, ab_Fire);
            }
            #endregion

        }

        //If this is true the Spy will walk slowly for a second
        if(noShoot)
        {
            shotCooldown -= Time.deltaTime;
            //Reload Animation
            currentSpeed = reloadSpeed;
            if (shotCooldown <= 0)
            {
                if (bullet != null)
                {
                    bullet.SetActive(false);
                }
                shotCooldown = 1.5f;
                currentSpeed = normalSpeed;
                noShoot = false;
            }
        }


        //If sprint has been used up then increase cooldown until it's back to it's original time
        if(!canSprint && !buttonPressed)
        {
            cooldown += Time.deltaTime;
            if (cooldown >= sprint.cooldown)
            {
                speedDuration = sprint.abilityDuration;
                cooldown = sprint.cooldown;
                canSprint = true;
            }
        }
        //When sprint is pressed the merc will be able to run for a short period of time
        if (Input.GetButtonDown("Sprint") && canSprint && !buttonPressed)
        {
            buttonPressed = true;
            laser.SetActive(false);
           #region NetMsg_Sprint
           NetMsg_AB_Sprint ab_Sprint = new NetMsg_AB_Sprint();
           if (ClientManager.Instance != null)
           {
               //ab_Sprint.ConnectionID = client.ServerConnectionId;
               ab_Sprint.SprintValue = runningSpeed;
               ClientManager.Instance.Send(ab_Sprint);
           }
           #endregion
        }
        //The player can cancel their sprint
        else if (Input.GetButtonDown("Sprint") && speedDuration > 0)
        {
            speedDuration = 0;
        }
        //If sprinting
        if (buttonPressed)
        {
            currentSpeed = runningSpeed;
            speedDuration -= 0.01f;

            if (speedDuration <= 0)
            {
                PlayerStats.Instance.AbililitesUsed++;
                laser.SetActive(true);
                cooldown = speedDuration;
                canSprint = false;
                buttonPressed = false;
                currentSpeed = normalSpeed;
            }
        }
    }

    private void Step()
    {
        //if (audioSource != null && !audioSource.isPlaying)
        //{
        //    walkingSound.SetSourceProperties(audioSource);
        //    audioSource.Play();

        //    PlayerStats.Instance.Steps++;
        //}
    }

    private void Run()
    {
        //if (audioSource != null && !audioSource.isPlaying)
        //{
        //    burstRunSound.SetSourceProperties(audioSource);
        //    audioSource.Play();
        //}
    }
}
