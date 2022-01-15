let slider_index = 0;

function simpleSlider()
{
    //adding all sliders to array
    let slider_items = document.getElementsByClassName('item');
    let i;
    //for every slider add class to slide-out, and remove old slide-in classes
    for(i=0; i<slider_items.length; i++)
    {
        slider_items[i].classList.remove('slide-in');
        slider_items[i].classList.add('slide-out');

    }
    //for chosen slider(by slider index) remove slide-out class and add slide in 
    slider_items[slider_index].classList.remove('slide-out');
    slider_items[slider_index].classList.add('slide-in');
    //slider_index++ for future loop
    slider_index++;

    //reset loop
    if(slider_index > slider_items.length-1)
    {
        slider_index = 0;
    }

    //Recursion with 5s timeout
    setTimeout(simpleSlider, 5000);

}

simpleSlider();