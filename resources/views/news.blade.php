@extends('layouts.app')
@section('title')
<title> News</title>
@endsection

@section('content')

<div class="newsContainer container mt-5 mb-5">

    <h1>News</h1>
    <marquee behavior="" direction="right">
        WATCH THE LATESTS
        <span class="sp1">FOOTBALL</span> <i class="fa-regular fa-futbol"></i>
        <span class="sp2">NEWS</span> IN OUR SITE.
    </marquee>


    <div id="carouselExampleCaptions" class="carousel slide" style="height:500px">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div id="carouselInner" class="carousel-inner" style="height:500px">
            <div id="" class="carousel-item active">
                <img id="imgActive1" src="" class="d-block w-100" alt="...">
                <div class="carousel-caption ">

                    <p id="titleActive1" class="text-left fs-5">.</p>
                </div>
            </div>
            <div id="" class="carousel-item ">
                <img id="imgActive2" src="" class="d-block w-100" alt="...">
                <div class="carousel-caption ">

                    <p id="titleActive2" class="text-left fs-5">
                    </p>
                </div>
            </div>
            <div id="" class="carousel-item ">
                <img id="imgActive3" src="" class="d-block w-100" alt="...">
                <div class="carousel-caption ">

                    <p id="titleActive3" class="text-left fs-5"></p>
                </div>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div id="rowCards" class="row gy-4 py-5">
        <div class="loader-background d-flex justify-content-center align-items-center">
            <span class="loader position-absolute"></span>
        </div>

    </div>

</div>


<script>
const urlSlider = 'https://football-news-aggregator-live.p.rapidapi.com/news/espn';
const optionsSlider = {
    method: 'GET',
    headers: {
        'x-rapidapi-key': 'b007fe281bmsh3971c288d73e0cbp199449jsn7adf9c94206c',
        'x-rapidapi-host': 'football-news-aggregator-live.p.rapidapi.com'
    }
};

var SliderList = [];

async function getNewsSlider() {
    try {
        const response = await fetch(urlSlider, optionsSlider);
        SliderList = await response.json();
        console.log(SliderList);

    } catch (error) {
        console.error(error);
    }
    displayNewsSlider()

}
getNewsSlider();



function displayNewsSlider() {
    const imgActive1 = document.getElementById('imgActive1');
    const titleActive1 = document.getElementById('titleActive1');
    titleActive1.innerHTML = SliderList[0].title;
    imgActive1.src = SliderList[0].img;

    const imgActive2 = document.getElementById('imgActive2');
    const titleActive2 = document.getElementById('titleActive2');
    titleActive2.innerHTML = SliderList[1].title;
    imgActive2.src = SliderList[1].img;

    const imgActive3 = document.getElementById('imgActive3');
    const titleActive3 = document.getElementById('titleActive3');
    titleActive3.innerHTML = SliderList[2].title;
    imgActive3.src = SliderList[2].img;


    var content = ``;
    for (let index = 3; index < SliderList.length; index++) {
        content +=
            `
               <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card" style="height:100%;">
                <img src="${SliderList[index].img}" class="card-img-top w-100" alt="news">
                <div class="card-body">
                    <p class="card-text">${SliderList[index].title}</p>
                    <a href="${SliderList[index].url}" class="text-decoration-none"><i class="fa-solid fa-arrow-right"></i> See More</a>
                </div>
            </div>
        </div>

        `;

    }
    document.getElementById('rowCards').innerHTML = content;

}
</script>

@endsection
