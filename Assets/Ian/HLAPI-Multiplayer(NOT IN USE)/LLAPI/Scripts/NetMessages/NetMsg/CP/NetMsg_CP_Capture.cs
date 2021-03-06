﻿using System.Collections;
using System.Collections.Generic;
using UnityEngine;

namespace LLAPI
{
    //capture point message
    [System.Serializable]
    public class NetMsg_CP_Capture : NetMsg_NetworkObject
    {
        public NetMsg_CP_Capture()
        {
            OP = NetOP.NETWORK_OBJECT;
        }

        public bool IsBeingCaptured { set; get; }
        public int Percentage { get; set; }
    }
}
