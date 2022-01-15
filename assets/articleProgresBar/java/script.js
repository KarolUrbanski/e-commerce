function articleProgresBar()
{
    let doc = document.documentElement;
    let scroll_Top = doc['scrollTop'];
    let scroll_Height = doc['scrollHeight'] - window.innerHeight;
    let scroll_Percent = scroll_Top / scroll_Height * 100;

    scroll_Percent = scroll_Percent.toFixed(2) + '%';

    document.querySelector('.article-progress-bar').style.setProperty('--scrollAmount', scroll_Percent);
}

document.addEventListener('scroll', articleProgresBar);