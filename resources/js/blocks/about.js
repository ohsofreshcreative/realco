  // --- NOWY KOD - PARALLAX DLA ZDJĘĆ (Z ZRÓŻNICOWANYM EFEKTEM) ---
  const triggerElement = document.querySelector(".b-about .__photos");

  if (triggerElement) {
    // Funkcja pomocnicza pozostaje bez zmian
    const createParallax = (selector, amount) => {
      const el = triggerElement.querySelector(selector);
      if (el) {
        gsap.fromTo(el, 
          { y: -amount },
          {
            y: amount,
            ease: "none",
            scrollTrigger: {
              trigger: triggerElement,
              scrub: 1.5, // Wygładzanie ruchu
              start: "top bottom",
              end: "bottom top",
            }
          }
        );
      }
    };

    // --- TUTAJ ZMIENIAMY WARTOŚCI ---
    // Możesz dowolnie eksperymentować z tymi liczbami, aby uzyskać idealny efekt.

    // Obrazki idące w dół (zgodnie ze scrollem)
    createParallax(".__img1", 25);  // Główny obrazek - ruch subtelny
    createParallax(".__img3", 55);  // Ten sam kierunek co img1, ale jeszcze wolniej

    // Obrazki idące w górę (przeciwnie do scrolla)
    createParallax(".__img2", -60); // Kierunek przeciwny, dość wolny
    createParallax(".__img4", -80); // Kierunek przeciwny, trochę szybszy dla dynamiki
  }