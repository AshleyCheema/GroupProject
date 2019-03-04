﻿using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FogProjector : MonoBehaviour
{
    [SerializeField]
    private Material projectorMaterial;
    [SerializeField]
    private Material blurMat;

    [SerializeField]
    private float blendSpeed;
    [SerializeField]
    private int textureScale;

    [SerializeField]
    private RenderTexture fogTexture;

    private RenderTexture prevTexture;
    private RenderTexture currTexture;
    [SerializeField]
    private Projector projector;

    private float blendAmount;

    // Start is called before the first frame update
    void Awake()
    {
        //projector = GetComponent();
        projector.enabled = true;

        blurMat.SetVector("_Parameter", new Vector4(1, -1, 0, 0));

        prevTexture = GenerateTexture();
        currTexture = GenerateTexture();

        // Projector materials aren't instanced, resulting in the material asset getting changed.
        // Instance it here to prevent us from having to check in or discard these changes manually.
        projector.material = new Material(projectorMaterial);

        projector.material.SetTexture("_PrevTexture", prevTexture);
        projector.material.SetTexture("_CurrTexture", currTexture);

        StartNewBlend();
    }

    RenderTexture GenerateTexture()
    {
        RenderTexture rt = new RenderTexture(
            fogTexture.width * textureScale,
            fogTexture.height * textureScale,
            0,
            fogTexture.format)
        { filterMode = FilterMode.Bilinear };
        rt.antiAliasing = fogTexture.antiAliasing;

        return rt;
    }

    public void StartNewBlend()
    {
        StopCoroutine(BlendFog());
        blendAmount = 0;
        // Swap the textures
        Graphics.Blit(currTexture, prevTexture);
        Graphics.Blit(fogTexture, currTexture);

        RenderTexture temp = RenderTexture.GetTemporary(
            currTexture.width,
            currTexture.height,
            0,
            currTexture.format);

        temp.filterMode = FilterMode.Bilinear;

        Graphics.Blit(currTexture, temp, blurMat, 1);
        Graphics.Blit(temp, currTexture, blurMat, 2);

        StartCoroutine(BlendFog());

        RenderTexture.ReleaseTemporary(temp);
    }

    IEnumerator BlendFog()
    {
        while (blendAmount < 1)
        {
            // increase the interpolation amount
            blendAmount += Time.deltaTime * blendSpeed;
            // Set the blend property so the shader knows how much to lerp
            // by when checking the alpha value
            projector.material.SetFloat("_Blend", blendAmount);
            yield return null;
        }
        // once finished blending, swap the textures and start a new blend
        StartNewBlend();
    }
}
