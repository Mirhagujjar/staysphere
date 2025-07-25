<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dynamic Scroll Button</title>
  <style>
    /* Basic Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      min-height: 2000px; /* For testing scroll */
      font-family: Arial, sans-serif;
    }

    /* Scroll Button Styles */
    #scrollButton {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background-color: #1A1A40;
      color: white;
      z-index: 9999;
      display: none;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    #scrollButton svg {
      width: 24px;
      height: 24px;
      transition: transform 0.3s ease;
    }

    .scroll-fill {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 0%;
      background-color: #d3d3d3;
      z-index: -1;
      border-radius: 50%;
      transition: height 0.3s ease;
    }
  </style>
</head>
<body>

  <!-- Dynamic Scroll Button -->
  <div id="scrollButton">
    <div class="scroll-fill"></div>
    <svg viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M8.87975 23.0051C9.50041 23.6398 10.5084 23.6398 11.129 23.0051L19.0735 14.8801C19.6941 14.2453 19.6941 13.2145 19.0735 12.5797C18.4528 11.9449 17.4449 11.9449 16.8242 12.5797L11.5908 17.9371V2.35742C11.5908 1.45859 10.8808 0.732422 10.0019 0.732422C9.12305 0.732422 8.41301 1.45859 8.41301 2.35742V17.932L3.17961 12.5848C2.55895 11.95 1.551 11.95 0.930339 12.5848C0.309679 13.2195 0.309679 14.2504 0.930339 14.8852L8.87478 23.0102L8.87975 23.0051Z"
            fill="white"/>
    </svg>
  </div>

  <script>
    const scrollBtn = document.getElementById("scrollButton");
    const scrollFill = document.querySelector(".scroll-fill");
    const arrowSvg = scrollBtn.querySelector("svg");
    
    let lastScrollPosition = window.scrollY;
    let isScrollingDown = false;

    window.addEventListener("scroll", () => {
      const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrollPercent = (scrollTop / docHeight) * 100;

      // Determine scroll direction
      isScrollingDown = scrollTop > lastScrollPosition;
      lastScrollPosition = scrollTop;

      // Show button when scrolled more than 100px
      if (scrollTop > 100 || scrollPercent < 100) {
        scrollBtn.style.display = "flex";
      } else {
        scrollBtn.style.display = "none";
      }

      // Rotate arrow based on scroll direction
      if (isScrollingDown) {
        arrowSvg.style.transform = "rotate(0deg)";
      } else {
        arrowSvg.style.transform = "rotate(180deg)";
      }

      // Fill the background based on scroll %
      scrollFill.style.height = scrollPercent + "%";
    });

    scrollBtn.addEventListener("click", () => {
      if (isScrollingDown) {
        // If currently scrolling down, scroll to bottom
        window.scrollTo({
          top: document.documentElement.scrollHeight,
          behavior: "smooth"
        });
      } else {
        // If currently scrolling up, scroll to top
        window.scrollTo({
          top: 0,
          behavior: "smooth"
        });
      }
    });
  </script>
</body>
</html>