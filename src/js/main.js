gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function () {
    // Example: Add a click event listener to a button
    const exampleButton = document.getElementById('exampleButton');
    if (exampleButton) {
        exampleButton.addEventListener('click', function () {
            alert('Button clicked!');
        });
    }

    gsap.utils.toArray('.cat').forEach(cat => {
        gsap.from(cat, {
            opacity: 0,
            y: 50,
            duration: 0.8,
            scrollTrigger: {
                trigger: cat,
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });
    });

    gsap.utils.toArray('.book').forEach(book => {
        gsap.from(book, {
            opacity: 0,
            x: 80,
            duration: 0.8,
            scrollTrigger: {
                trigger: book,
                start: "top 85%",
                toggleActions: "play none none none"
            }
        });
    });
});




