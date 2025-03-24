@extends('layout.visitor.navbar')

@section('content')
<style>
    body {
        cursor: ; /* Hide default cursor */
    }

    .play-reel-button {
        position: fixed; /* Changed from absolute to fixed */
        width: 110px;
        height: 110px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        pointer-events: none; /* Ensures it doesn't interfere with clicks */
        z-index: 1000;
        transform: translate(-50%, -50%); /* Center the cursor on pointer position */
    }

    .play-reel-text {
        font-weight: bold;
        font-size: 18px;
        line-height: 1.2;
        text-align: center;
        margin-top: 5px;
    }

    .basic-info {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        text-align: center;
        font-size: 18px;
        z-index: 10;
    }

    /* Make sure the cursor appears over the navbar too */
    header {
        z-index: 100;
    }

    /* Hide the default cursor */
    #home{
        cursor: none;
    }
    

</style>

<div class="relative h-screen overflow-hidden " id="home">
    <!-- Background Video -->
    <video autoplay muted loop class="absolute w-full h-full object-cover">
        <source src="{{ asset('videos/HACK&GO.webm') }}" type="video/webm">
    </video>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/15"></div>

    <!-- Play Reel Button Cursor -->
    <div class="play-reel-button">
        <div class="play-reel-text">PLAY<br>REEL</div>
    </div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cursor = document.querySelector('.play-reel-button');
        const navbar = document.querySelector('header');

        document.addEventListener('mousemove', function(e) {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';

            // Check if mouse is over navbar
            const navbarRect = navbar.getBoundingClientRect();
            if (e.clientY <= navbarRect.bottom) {
                cursor.style.display = 'none'; // Hide custom cursor over navbar
                cursor.style.cursor = 'pointer';
            } else {
                cursor.style.display = 'flex'; // Show custom cursor elsewhere
            }
        });
    });
</script>
@endsection
