const images = [
    "images/rr.jpg",
    "images/2.jpg",
    "images/3.jpg",
    "images/4,jpg",
    "images/5.jpg",
    "images/6.jpg"
  ];
  
  let index = 0;
  const heroSection = document.getElementById('home');
  
  setInterval(() => {
    heroSection.style.backgroundImage = `url('${images[index]}')`;
    index = (index + 1) % images.length;
  }, 900); // 0.9 secondes = 900 millisecondes
  