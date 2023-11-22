<!DOCTYPE html>
<html>
<head>
    <style>
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }

        .logo-container:hover .logo-icon {
            transform: scale(1.1);
            stroke: #ff5733; /* Couleur différente au survol */
        }

        .logo-container:hover .logo-text {
            color: #ff5733; /* Couleur différente au survol */
        }

        .logo-text {
            font-size: 24px;
            color: indigo;
            margin-top: 10px;
            transition: color 0.5s ease-in-out;
        }
    </style>
</head>
<body>

<div class="logo-container" style="display: flex; align-items: center; justify-content: center; flex-direction: column; cursor: pointer;">
    <svg class="w-7 h-7 logo-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 20%; height: 20%; fill: none; stroke: indigo; stroke-width: 2;">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l-6-6m0 0l6-6m6 6l6-6"></path>
    </svg>
    <h1 class="logo-text">S'C<span id="left-eye" style="animation: blink 1s infinite;">oo</span>l</h1>
</div>

<script>
    const logoIcon = document.querySelector('.logo-icon');
    const logoText = document.querySelector('.logo-text');
    const colors = ['#ff5733', '#1abc9c', '#3498db', '#e74c3c', '#9b59b6'];
    let colorIndex = 0;

    function animateLogo() {
        // Animation de rotation en haut
        logoIcon.style.transition = 'transform 0.5s ease-in-out';
        logoIcon.style.transform = 'translateY(-10px)';
        logoIcon.style.stroke = colors[colorIndex];

        setTimeout(() => {
            // Animation de retour à la position d'origine
            logoIcon.style.transition = 'transform 0.5s ease-in-out';
            logoIcon.style.transform = 'translateY(0)';
            logoIcon.style.stroke = 'indigo';
        }, 500);

        // Animation de changement de couleur du texte
        logoText.style.transition = 'color 0.5s ease-in-out';
        logoText.style.color = colors[colorIndex];

        // Incrémente l'index de couleur
        colorIndex = (colorIndex + 1) % colors.length;
    }

    setInterval(animateLogo, 2000);
</script>
</body>
</html>








{{-- <div class="logo-container" style="display: flex; align-items: center; justify-content: center; flex-direction: column; cursor: pointer;">
    <svg class="w-5 h-7 logo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="width: 100px; height: 100px; fill: none; stroke: indigo; stroke-width: 2;">
        <path d="M12 4v14l4-4v-10h-8v10l4 4z" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
    <h1 class="logo-text" style="font-size: 24px; color: indigo; margin-top: 10px;">S'cool</h1>
</div>

<script>
    const logoIcon = document.querySelector('.logo-icon');
    const logoText = document.querySelector('.logo-text');
    const colors = ['#ff5733', '#1abc9c', '#3498db', '#e74c3c', '#9b59b6'];
    let colorIndex = 0;

    function animateLogo() {
        logoIcon.style.transition = 'transform 1s ease-in-out';
        logoIcon.style.transform = 'rotate(90deg)';
        logoIcon.style.stroke = colors[colorIndex];

        setTimeout(() => {
            logoIcon.style.transition = 'transform 1s ease-in-out';
            logoIcon.style.transform = 'rotate(0deg)';
            logoIcon.style.stroke = 'indigo';
        }, 1000);

        // Change la couleur du texte
        logoText.style.transition = 'color 1s ease-in-out';
        logoText.style.color = colors[colorIndex];

        // Incrémente l'index de couleur
        colorIndex = (colorIndex + 1) % colors.length;
    }

    setInterval(animateLogo, 3000);
</script> --}}
