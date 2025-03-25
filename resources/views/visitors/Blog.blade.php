@extends('layout.visitor.navbar')

@section('content')
<style>
    body {
        cursor: auto; /* Default cursor for body */
    }

    .play-reel-button {
        position: fixed;
        width: 110px;
        height: 110px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        pointer-events: none;
        z-index: 1000;
        transform: translate(-50%, -50%);
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

    header {
        z-index: 100;
    }

    #home, #video-modal {
        cursor: none;
    }
</style>

<div class="relative h-screen overflow-hidden cursor-pointer" id="home">
    <video autoplay muted loop class="absolute w-full h-full object-cover" id="background-video">
        <source src="{{ asset('videos/HA.mp4') }}" type="video/mp4">
    </video>

    <!-- Audio element that will play with the video -->
    <audio id="background-audio" loop>
        <source src="{{ asset('audio/background-music.mp3') }}" type="audio/mp3">
    </audio>

    <div class="absolute inset-0 bg-black/25"></div>

    <div class="play-reel-button">
        <div class="play-reel-text text-black bold">LIVE the<br>MOMENT</div>
    </div>
</div>

<div id="video-modal" class="fixed inset-0 bg-black z-50 hidden flex items-center justify-center transition-opacity duration-300">
    <div class="relative w-full h-full cursor-none" id="close-modal">
        <video autoplay loop class="absolute w-full h-full object-cover" id="fullscreen-video">
            <source src="{{ asset('videos/HACK.webm') }}" type="video/webm">
        </video>

        <!-- Audio element for the fullscreen video -->
        <audio id="fullscreen-audio" loop preload="auto">
            <source src="{{ asset('audio/HACK.m4a') }}" type="audio/mp4">
            <source src="{{ asset('audio/HACK.mp3') }}" type="audio/mpeg">
        </audio>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cursor = document.querySelector('.play-reel-button');
        const navbar = document.querySelector('header');
        const homeDiv = document.getElementById('home');
        const videoModal = document.getElementById('video-modal');
        const fullscreenVideo = document.getElementById('fullscreen-video');
        const closeModalBtn = document.getElementById('close-modal');

        // Get audio elements
        const backgroundAudio = document.getElementById('background-audio');
        const fullscreenAudio = document.getElementById('fullscreen-audio');

        let isModalOpen = false;

        // Add timeupdate event to check video progress
        fullscreenVideo.addEventListener('timeupdate', function() {
            // Check if video has reached 1:51 (111 seconds)
            if (fullscreenVideo.currentTime >= 111) {
                // Close the modal and return to home
                videoModal.classList.add('hidden');
                fullscreenVideo.pause();
                fullscreenVideo.currentTime = 0;

                // Pause fullscreen audio and resume background audio
                fullscreenAudio.pause();
                fullscreenAudio.currentTime = 0;
                backgroundAudio.play();

                isModalOpen = false;
            }
        });

        document.addEventListener('mousemove', function(e) {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';

            const isInHomeSection = homeDiv.contains(e.target);

            // Check if modal is open - keep cursor hidden if true
            if (isModalOpen) {
                cursor.style.display = 'none';
                return;
            }

            // Check if mouse is over navbar
            const navbarRect = navbar.getBoundingClientRect();
            if (e.clientY <= navbarRect.bottom || !isInHomeSection) {
                cursor.style.display = 'none';
            }
            else {
                cursor.style.display = 'flex';
            }
        });

        homeDiv.addEventListener('click', function() {
            videoModal.classList.remove('hidden');
            if (fullscreenVideo) {
                fullscreenVideo.play();

                // Pause background audio and play fullscreen audio
                backgroundAudio.pause();
                fullscreenAudio.play();
            }
            cursor.style.display = 'none';
            isModalOpen = true;
        });

        closeModalBtn.addEventListener('click', function() {
            videoModal.classList.add('hidden');
            fullscreenVideo.pause();
            fullscreenVideo.currentTime = 0;

            // Pause fullscreen audio and resume background audio
            fullscreenAudio.pause();
            fullscreenAudio.currentTime = 0;
            backgroundAudio.play();

            isModalOpen = false;
        });

        videoModal.addEventListener('click', function(e) {
            if (e.target === videoModal) {
                videoModal.classList.add('hidden');
                fullscreenVideo.pause();
                fullscreenVideo.currentTime = 0;

                // Pause fullscreen audio and resume background audio
                fullscreenAudio.pause();
                fullscreenAudio.currentTime = 0;
                backgroundAudio.play();

                isModalOpen = false;
            }
        });

        // Play background audio when page loads
        // Using a user interaction to start audio (to comply with autoplay policies)
        document.body.addEventListener('click', function() {
            if (!backgroundAudio.playing) {
                backgroundAudio.play();
            }
        }, { once: true });
    });
</script>
@endsection
