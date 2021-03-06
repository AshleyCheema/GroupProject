﻿using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using TMPro;
using UnityEngine.UI;

public class CooldownScript : MonoBehaviour
{
    public Image CooldownImage;
    public float CooldownTime;
    public Button Action;
    private float currentCooldown = 0;
    public SpyController spyController;
    public MercControls mercControls;
    public TrackerAbility trackerAbility;
    public Sprite trackerActiveSprite;
    public Sprite burstActiveSprite;
    //public Sprite sprintActiveSprite;
    private Image sprite;
    private Color activeColor = new Color(127, 194, 233, 255);
    private Sprite notActiveSprite;

    public GameObject keyboardButton;
    public GameObject ControllerButton;

    public bool canHack;
    private bool isSpy;
    private bool isMerc;
    public AbilityType abilityType;

    public enum AbilityType
    {
        //Spy
        SPRINT,
        STUN,
        HACK,
        //Merc
        TRACKER,
        BURST,
        FIRE
    }

    // Start is called before the first frame update
    private void Start()
    {

        sprite = GetComponent<Image>();
        notActiveSprite = sprite.sprite;

        if (mercControls != null)
        {
            isMerc = true;
        }
        if(spyController != null)
        {
            isSpy = true;
        }
        Action.interactable = false;
        currentCooldown = CooldownTime;
        CooldownImage.fillAmount = Mathf.InverseLerp(0, 1, CooldownTime);

        if(Input.GetJoystickNames().Length > 0)
        {
            ControllerButton.SetActive(true);
        }
        else
        {
            keyboardButton.SetActive(true);
        }
    }

    // Update is called once per frame
    private void Update()
    {
        if (currentCooldown < CooldownTime)
        {
            CooldownImage.color = new Color32(102, 102, 102, 255);
            currentCooldown += Time.deltaTime;
            CooldownImage.fillAmount = currentCooldown / CooldownTime;
        }
        if (CooldownImage.fillAmount == 1 && Action.interactable == false)
        {
            Action.interactable = true;
            //Debug.Log("Cooldown finished");
            CooldownImage.color = new Color32(103, 201, 255, 255);
            Invoke("ResetColour", 0.25F);
        }

        if (isSpy)
        {
            //Debug.Log("Skill '" + Action.name + "' has been clicked");
            if (spyController.isRunning && Action.interactable && abilityType == AbilityType.SPRINT)
            {
                sprite.sprite = burstActiveSprite;
                //Action.interactable = false;
                //currentCooldown = 0;
            }
            else if(abilityType == AbilityType.SPRINT)
            {
                sprite.sprite = notActiveSprite;
            }

            if(spyController.stunDrop && Action.interactable && abilityType == AbilityType.STUN)
            {
                Action.interactable = false;
                currentCooldown = 0;
            }

            if(canHack && abilityType == AbilityType.HACK)
            {
                sprite.sprite = trackerActiveSprite;

            }
            else if(abilityType == AbilityType.HACK)
            {
                sprite.sprite = notActiveSprite;
            }
        }

        if (isMerc)
        {
            if (mercControls.noShoot && Action.interactable && abilityType == AbilityType.FIRE)
            {
                Action.interactable = false;
                currentCooldown = 0;
            }
            if (!mercControls.canSprint && Action.interactable && abilityType == AbilityType.BURST)
            {
                Action.interactable = false;
                currentCooldown = 0;
            }

            if (mercControls.buttonPressed && mercControls.canSprint && abilityType == AbilityType.BURST)
            {
                sprite.sprite = burstActiveSprite;
            }
            else if(abilityType == AbilityType.BURST)
            {
                sprite.sprite = notActiveSprite;
            }

            if (trackerAbility.trackerDown && Action.interactable && abilityType == AbilityType.TRACKER)
            {
                Action.interactable = false;
                currentCooldown = 0;
            }

            if (trackerAbility.trackerActive && !trackerAbility.trackerDown && abilityType == AbilityType.TRACKER)
            {
                sprite.sprite = trackerActiveSprite;
            }
            else if(abilityType == AbilityType.TRACKER)
            {
                sprite.sprite = notActiveSprite;
            }
        }
    }

    private void ResetColour()
    {
        CooldownImage.color = new Color32(255, 255, 255, 255);
    }
}