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
        <source src="https://rr4---sn-h5qzened.googlevideo.com/videoplayback?expire=1742837443&ei=Y0LhZ-XRHKjRp-oPz5eQ8AE&ip=176.1.223.37&id=o-AK9HdH2sILHYtIbn-VX6VQfGMuAm_1h84N-CHxRqmnFa&itag=313&aitags=133%2C134%2C135%2C136%2C137%2C160%2C242%2C243%2C244%2C247%2C248%2C271%2C278%2C313&source=youtube&requiressl=yes&xpc=EgVo2aDSNQ%3D%3D&bui=AccgBcNfq5uIHkzNhmyzaqboiT8oyr2ZYFKpXvof2n3f_hn3vC4evyoVW34Yx28cNgnLafLnUtE234VM&spc=_S3wKsocd6Y_5fuRigNzwxlVMR0AlGCfHF31f7oVakyMDxQlQQ&vprv=1&svpuc=1&mime=video%2Fwebm&ns=5BMGaCJBcpYKLhmS5cR-AlcQ&rqh=1&gir=yes&clen=114830085&dur=111.193&lmt=1695244864148387&keepalive=yes&fexp=24350590,24350737,24350778,24350827,24350961,24351147,24351173,24351177,24351283,24351353,24351394,24351396,24351398,24351468,51355912&c=WEB&sefc=1&txp=5319224&n=wQjjVoIaMNuxuQ&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cxpc%2Cbui%2Cspc%2Cvprv%2Csvpuc%2Cmime%2Cns%2Crqh%2Cgir%2Cclen%2Cdur%2Clmt&sig=AJfQdSswRAIgRWTrY_KK_J3Sa3tjSnfQSyFItu9KzHFnBxag_0PoA_UCIHQCPAg6bR21enA2jIwkVJJwQet9Gvqdg2q_pyCG_yMH&pot=MnStG18rFtRPF60nBkVFVmfGH5kMY_LJmF7Jq3CGwH3VReIUtjBhPvLKJQGYmlBofCex5D32jyV7t3MTe-94vXx1Tq2z0jAzAcqOak9rtRkblwHeM3QLDdekL9BlWg49e7y6YyBTWcM-UMTPIz6QgOFLZysstw==&rm=sn-uxax4vopj5qx-q0n67l,sn-4g5erd7s&rrc=79,104&req_id=fc14140cee8da3ee&rms=rdu,au&redirect_counter=2&cms_redirect=yes&cmsv=e&ipbypass=yes&met=1742815862,&mh=oS&mip=197.230.119.22&mm=29&mn=sn-h5qzened&ms=rdu&mt=1742815754&mv=m&mvi=4&pl=25&lsparams=ipbypass,met,mh,mip,mm,mn,ms,mv,mvi,pl,rms&lsig=AFVRHeAwRAIgfMZqKCvrgNygYyOn0CsvdhR3_xoMTznipYhnaEsDHmACIFrpVZ0qUwLV3lvlD2zZtSKCTzKM2N7Mz8MHnvydPWXR" >
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
