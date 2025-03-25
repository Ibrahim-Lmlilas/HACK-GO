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

<div class="relative h-screen overflow-hidden cursor-pointer" id="home">
    <!-- Background Video -->
    <video autoplay muted loop class="absolute w-full h-full object-cover" id="background-video">
        <source src="https://rr4---sn-h5qzened.googlevideo.com/videoplayback?expire=1742837443&ei=Y0LhZ-XRHKjRp-oPz5eQ8AE&ip=176.1.223.37&id=o-AK9HdH2sILHYtIbn-VX6VQfGMuAm_1h84N-CHxRqmnFa&itag=313&aitags=133%2C134%2C135%2C136%2C137%2C160%2C242%2C243%2C244%2C247%2C248%2C271%2C278%2C313&source=youtube&requiressl=yes&xpc=EgVo2aDSNQ%3D%3D&bui=AccgBcNfq5uIHkzNhmyzaqboiT8oyr2ZYFKpXvof2n3f_hn3vC4evyoVW34Yx28cNgnLafLnUtE234VM&spc=_S3wKsocd6Y_5fuRigNzwxlVMR0AlGCfHF31f7oVakyMDxQlQQ&vprv=1&svpuc=1&mime=video%2Fwebm&ns=5BMGaCJBcpYKLhmS5cR-AlcQ&rqh=1&gir=yes&clen=114830085&dur=111.193&lmt=1695244864148387&keepalive=yes&fexp=24350590,24350737,24350778,24350827,24350961,24351147,24351173,24351177,24351283,24351353,24351394,24351396,24351398,24351468,51355912&c=WEB&sefc=1&txp=5319224&n=wQjjVoIaMNuxuQ&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cxpc%2Cbui%2Cspc%2Cvprv%2Csvpuc%2Cmime%2Cns%2Crqh%2Cgir%2Cclen%2Cdur%2Clmt&sig=AJfQdSswRAIgRWTrY_KK_J3Sa3tjSnfQSyFItu9KzHFnBxag_0PoA_UCIHQCPAg6bR21enA2jIwkVJJwQet9Gvqdg2q_pyCG_yMH&pot=MnStG18rFtRPF60nBkVFVmfGH5kMY_LJmF7Jq3CGwH3VReIUtjBhPvLKJQGYmlBofCex5D32jyV7t3MTe-94vXx1Tq2z0jAzAcqOak9rtRkblwHeM3QLDdekL9BlWg49e7y6YyBTWcM-UMTPIz6QgOFLZysstw==&rm=sn-uxax4vopj5qx-q0n67l,sn-4g5erd7s&rrc=79,104&req_id=fc14140cee8da3ee&rms=rdu,au&redirect_counter=2&cms_redirect=yes&cmsv=e&ipbypass=yes&met=1742815862,&mh=oS&mip=197.230.119.22&mm=29&mn=sn-h5qzened&ms=rdu&mt=1742815754&mv=m&mvi=4&pl=25&lsparams=ipbypass,met,mh,mip,mm,mn,ms,mv,mvi,pl,rms&lsig=AFVRHeAwRAIgfMZqKCvrgNygYyOn0CsvdhR3_xoMTznipYhnaEsDHmACIFrpVZ0qUwLV3lvlD2zZtSKCTzKM2N7Mz8MHnvydPWXR" >
    </video>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/15"></div>

    <!-- Play Reel Button Cursor -->
    <div class="play-reel-button">
        <div class="play-reel-text">PLAY<br>REEL</div>
    </div>
</div>

<!-- Fullscreen Video Modal -->
<div id="video-modal" class="fixed inset-0 bg-black z-50 hidden flex items-center justify-center">
    <button id="close-modal" class="absolute top-4 right-4 text-white text-3xl z-50 hover:text-gray-300">&times;</button>
    <video id="fullscreen-video" class="w-full h-full object-contain" controls>
        <source src="https://rr5---sn-5hneknek.googlevideo.com/videoplayback?expire=1742838290&ei=skXhZ4GdDf3Qi9oPvJuawAQ&ip=176.1.205.240&id=o-AJYh9gdButPK3BCyryaqjKylYlLFoZLPCReEPeZZKI5p&itag=702&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278%2C298%2C299%2C302%2C303%2C308%2C315%2C330%2C331%2C332%2C333%2C334%2C335%2C336%2C337%2C694%2C695%2C696%2C697%2C698%2C699%2C700%2C701%2C702&source=youtube&requiressl=yes&xpc=EgVo2aDSNQ%3D%3D&bui=AccgBcM4ogAzdAIKtjPvP0mzCps3JQTZiLbchh_9BHz894kISdUhxle8zpmGdOpTz4ooxqGb0mj3iWzx&spc=_S3wKp0hBAorseEw3QwFojuU7giKs_8oKdOwNWxqTxj2nrSqeA&vprv=1&svpuc=1&mime=video%2Fmp4&ns=H3IBNDdjYMnMfOHmPNbh4W4Q&rqh=1&gir=yes&clen=1857122439&dur=295.645&lmt=1726446529219555&keepalive=yes&fexp=24350590,24350737,24350778,24350827,24350961,24351146,24351173,24351283,24351353,24351394,24351396,24351398,24351466,24351468,51355912&c=WEB&sefc=1&txp=4502434&n=aE6aamogKIHT9A&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cxpc%2Cbui%2Cspc%2Cvprv%2Csvpuc%2Cmime%2Cns%2Crqh%2Cgir%2Cclen%2Cdur%2Clmt&sig=AJfQdSswRgIhAL2Ya9vGopaidFpBM_QA752i_-ulDxYsOCsHt9kM8jEUAiEA1k1m5-9Lrdh-d9o-Mk8bU1OcQQU_E2hWZCdVF6-70Dc%3D&pot=MpQBQsl2cPvimahC9bHQm5ecSFF9Ea4ujC-U-h82G8FxHk-t0gQbN06hDqG6cTK-H-rckdpEu1Zi6sBIpQ8ZYJ5Kw0t6efqSV-R1nvWt5FtMs_e7kxFtNWoCsCG-AQdcWpS83HwhOLqmOotiodnnJcTpj-ZZMybb5jT6x2Maw8JIreZJqReheFP1b1dYmjQ17-G6k5qbMg==&rm=sn-uxax4vopj5qx-q0n67s,sn-4g5ezd7l,sn-h5q6k76&rrc=79,104,40&req_id=2dabe07077dccc45&rms=rdu,au&ipbypass=yes&redirect_counter=3&cms_redirect=yes&cmsv=e&met=1742827563,&mh=fB&mip=197.230.119.21&mm=34&mn=sn-5hneknek&ms=ltu&mt=1742827247&mv=m&mvi=5&pl=25&tso=10858&lsparams=ipbypass,met,mh,mip,mm,mn,ms,mv,mvi,pl,rms,tso&lsig=AFVRHeAwRQIgVppmlu2jB1MWZjU-q_t33alBaAQIla_ltktkCVS3kPECIQDbFM4WdulYtD9ZikS8l2gMHwcqYqTLnwCXEKmE-nsIRA%3D%3D" type="video/mp4">
    </video>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cursor = document.querySelector('.play-reel-button');
        const navbar = document.querySelector('header');
        const homeDiv = document.getElementById('home');
        const videoModal = document.getElementById('video-modal');
        const fullscreenVideo = document.getElementById('fullscreen-video');
        const closeModalBtn = document.getElementById('close-modal');

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

        // Open fullscreen video when clicking on home div
        homeDiv.addEventListener('click', function() {
            videoModal.classList.remove('hidden');
            fullscreenVideo.play();
            cursor.style.display = 'none'; // Hide custom cursor when modal is open
        });

        // Close modal when clicking close button
        closeModalBtn.addEventListener('click', function() {
            videoModal.classList.add('hidden');
            fullscreenVideo.pause();
            fullscreenVideo.currentTime = 0;
        });

        // Also close modal when clicking outside the video
        videoModal.addEventListener('click', function(e) {
            if (e.target === videoModal) {
                videoModal.classList.add('hidden');
                fullscreenVideo.pause();
                fullscreenVideo.currentTime = 0;
            }
        });

        // Show cursor again when modal is closed
        videoModal.addEventListener('transitionend', function() {
            if (videoModal.classList.contains('hidden')) {
                const navbarRect = navbar.getBoundingClientRect();
                const mouseY = parseInt(cursor.style.top);
                if (mouseY > navbarRect.bottom) {
                    cursor.style.display = 'flex';
                }
            }
        });
    });
</script>
@endsection
