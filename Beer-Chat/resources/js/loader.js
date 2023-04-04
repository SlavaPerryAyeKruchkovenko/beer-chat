let isAnimate = false;
let requestId = 0;

startAnimate = () => {
    isAnimate = true;
    const circle = document.getElementById("circle");
    const circumference = 2 * Math.PI * circle.r.baseVal.value;
    circle.style.strokeDasharray = `${circumference} 1000`;

    function setProgress(percent) {
        circle.style.strokeDashoffset = circumference * (1 - percent / 33);
    }

    requestId = requestAnimationFrame(draw)

    function draw(t) {
        if(isAnimate){
            requestAnimationFrame(draw);
            setProgress((t/33)%33);
        }
    }
}
stopAnimate = () => {
    isAnimate = false;
    cancelAnimationFrame(requestId);
}
