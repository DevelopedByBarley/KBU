document.addEventListener("mousemove", parallax);

function parallax(event) {
    this.querySelectorAll(".parallax-wrap img").forEach((shift) => {
        const position = shift.getAttribute("parallax");
        console.log(position);
        const x = (window.innerWidth - event.pageX * position) / 90;
        const y = (window.innerHeight - event.pageY * position) / 90;

        console.log();

        shift.style.transform = `translateX(${x}px) translateY(${y}px)`;
    });
}