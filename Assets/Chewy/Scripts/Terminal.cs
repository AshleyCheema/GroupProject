using System.Collections;
using System.Collections.Generic;
using UnityEngine;
/// <summary>
/// The hacking terminal checks if the mouse is hovered over the object which then highlights
/// If the player is close enough to the terminal gameobject then they can hack it an access stuff...
/// </summary>
public class Terminal : MonoBehaviour
{
    //public Camera camera;
    private Renderer renderer;
    private GameController gameController;
    [SerializeField]
    private GameObject hackingCanvas;
    [SerializeField]
    private GameObject hackOutput;

    // Use this for initialization
    void Start ()
    {
        renderer = GetComponent<Renderer>();
        gameController = GameObject.FindGameObjectWithTag("Player").GetComponent<GameController>();
    }
	
	// Update is called once per frame
	void Update ()
    {
        //Check if the camera is enabled
        //if (camera.enabled == true)
        //{
        //    //if so and the escape is pressed then turn off camera and re-enable player controls
        //    if (Input.GetKeyDown(KeyCode.Escape))
        //    {
        //        gameController.enabled = true;
        //        camera.enabled = false;
        //    }
        //}
    }

    public void Enable()
    {
        if (hackOutput.activeInHierarchy == true)
        {
            Debug.Log("Terminal is enabled");
            hackingCanvas.SetActive(true);
            gameController.enabled = false;
        }

    }

    public void Hack()
    {
        bool result = hackingCanvas.GetComponent<HackingPuzzleManager>().StartPuzzle();

        hackingCanvas.SetActive(false);
        gameController.enabled = true;

        if(result)
        {
            Debug.Log("Hack Complete");
            hackOutput.SetActive(false);
        }
        else
        {
            Debug.Log("Hack Failed");
        }
    }

    //Hover mouse over gameobject, this will change it's colour.
    //If the player is close enough to the gameobject it is hackable
    private void OnMouseOver()
    {
        renderer.material.SetColor(Color.red);
        if (gameController.isTerminal == true)
        {
            //if (Input.GetMouseButtonDown(1))
            //{
                //disable player controller
                gameController.enabled = false;
                //pop up canvas 
                hackingCanvas.SetActive(true);
                //camera.enabled = true;
            //}
        }
    }

    private void HackingCompleted(bool a_result)
    {

    }

    //Change back to original colour when no longer hovered over
    private void OnMouseExit()
    {
        renderer.material.SetColor(Color.white);
    }
}