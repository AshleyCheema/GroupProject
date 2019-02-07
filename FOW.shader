﻿Shader "Custom/FOW"
{
    Properties
    {
        _MainTex ("Texture", 2D) = "white" {}
    }
    SubShader
    {
        Tags { "RenderType"="Opaque" }
        LOD 100

        Pass
        {
            CGPROGRAM
            #pragma vertex vert
            #pragma fragment frag
            // make fog work
            #pragma multi_compile_fog

            #include "UnityCG.cginc"

            struct appdata
            {
                float4 vertex : POSITION;
                float2 uv : TEXCOORD0;
            };

            struct v2f
            {
                float2 uv : TEXCOORD0;
				float4 darken : COLOR;
                float4 vertex : SV_POSITION;
            };

            sampler2D _MainTex;
            float4 _MainTex_ST;

            v2f vert (appdata v)
            {
                v2f o;
				//vertex to view space
                o.vertex.xyz = UnityObjectToViewPos(v.vertex.xyz);
                o.uv = TRANSFORM_TEX(v.uv, _MainTex);

				float4 playerPos = (0, 0, 0, 1);
				float4 center = float4(UnityObjectToViewPos(playerPos.xyz), 1.0);
				//o.darken.r = smoothstep(0.0, 1.0, distance(o.vertex, center));

                return o;
            }

            fixed4 frag (v2f i) : SV_Target
            {
                // sample the texture
                fixed4 col = tex2D(_MainTex, i.uv);
				return col;
            }
            ENDCG
        }
    }
}