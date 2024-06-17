<?php
$lang = $_COOKIE['lang'] ?? null;
?>
<div class="container-fluid vh-100">
  <div class="row h-100">
    <div class="col-12 d-flex align-items-center justify-content-center flex-column h-100 mt-5">
      <button class="toast-btn btn btn-info p-3 px-5 text-white">Toast!</button>
      <div class="blur-load" style="background-image: url('/public/assets/uploads/images/1_small.png'); background-position: center; background-size: cover; height: 300px; width: 300px;">
      </div>
    </div>
  </div>
</div>

<script>
  const blurDivs = document.querySelectorAll('.blur-load');

  const getUrlFromBgImage = (blurLoadStyle) => {
    // Az URL-t a háttérképre mutató rész után keressük
    const startIndex = blurLoadStyle.indexOf("url('") + 5;
    const endIndex = blurLoadStyle.indexOf("_small", startIndex);

    // Az URL részletet kiszedjük
    const backgroundImageUrl = blurLoadStyle.substring(startIndex, endIndex) + ".png";

    return backgroundImageUrl;
  }

  blurDivs.forEach(div => {

    const img = document.createElement('img');
    const blurLoadStyle = div.getAttribute('style');




    img.setAttribute('src', getUrlFromBgImage(blurLoadStyle));
    img.setAttribute('loading', 'lazy');

    div.appendChild(img)

    const loaded = () => {
      div.classList.add('loaded');
    }

    if (img.complete) {
      loaded();
    } else {
      img.addEventListener('load', loaded);
    }
  })
</script>

<style>
  .blur-load {
    position: relative;
    filter: blur(4px)
  }

  .blur-load::before {
    content: '';
    position: absolute;
    inset: 0;
    animation: pulse 2.5s infinite;
    background-color: rgba(255, 255, 255, .1);
  }

  .blur-load.loaded::before {
    content: none;
    animation: none;
  }

  .blur-load.loaded {
    filter: blur(0)
  }

  .blur-load.loaded img {
    opacity: 1;
  }

  .blur-load img {
    opacity: 0;
  }

  @keyframes pulse {
    0% {
      background-color: rgba(255, 255, 255, 0);

    }

    50% {
      background-color: rgba(255, 255, 255, .1);
    }

    100% {
      background-color: rgba(255, 255, 255, 0);

    }
  }
</style>