@extends('layouts.app')
@section('title')
<title>Highlights</title>

@endsection

@section('content')

<!-- start of highlights -->
<div id="highlights" class="highlights pt-3 pb-3">
    <div class="container">
        <h1 class="text-center">Highlights <i class="fa-solid fa-fire fa-beat-fade" style="color: #ff0000;"></i>
        </h1>
        <div class="mb-3 position-relative w-50 mx-auto">
            <input type="text" class="form-control rounded-pill   border-2" id="highlightSearch"
                placeholder="search by Competition or Team">
            <span class="position-absolute searchIcon text-black-50"><i
                    class="fa-solid fa-magnifying-glass"></i></span>
        </div>

        <div id="highlight" class="highlight-feeds w-100 d-flex ">
            <div class="loader-background d-flex justify-content-center align-items-center">
                <span class="loader position-absolute"></span>
            </div>


            {{-- <!-- @foreach ($highlights as $highlight)

            <div class="single-highlight">
                <p class="highlight-comp text-center">{{ $highlight['competition']}}</p>
                <div class="highlight-vid">{!!$highlight['videos']['0']['embed']!!}</div>
                <p class="highlight-title text-center">{{ $highlight['title']}}</p>
            </div>

            {{-- <p>{{ $dat['competition']}}</p> --}}

            {{-- @endforeach --> --}}
        </div>
        {{-- <div id="loadBtnContainer" class="d-flex justify-content-end">
            <button class="btn text-primary fs-5" id="loadBtn"><i class="fa-solid fa-plus"></i>
                Load More</button>
        </div> --}}


        {{-- <form action="{{ route('name') }}">
        <input type="submit" name="" id="">
        </form> --}}

    </div>
</div>
<!-- end of highlight -->


<script>
const highlightSearch = document.getElementById('highlightSearch');
var highlighList = [];

// Variables to manage state
var currentIndex = 0;
var increment = 6;

async function getHighlight() {
    var response = await fetch(
        `https://www.scorebat.com/video-api/v3/feed/?token=MTQ0NDc3XzE3MDkxNDE5MDJfODMzOWEzMGJiMTdkODFmMzRlODMyNmZmZmNmZWJhODIyZjE3MTdiNw==`
    );
    var finalData = await response.json();

    highlighList = finalData;
    console.log(highlighList.response);

    displayHighlights();
}
getHighlight();




function displayHighlights() {

    end = Math.min(currentIndex + increment, highlighList.response.length);

    var content = ``;
    for (let index = 0; index < highlighList.response.length; index++) {
        content +=
            `
            <div class="single-highlight">
                <p class="highlight-comp text-center">${highlighList.response[index].competition}</p>
                <div class="highlight-vid">${highlighList.response[index].videos[0].embed}</div>
                <p class="highlight-title text-center">${highlighList.response[index].title}</p>
            </div>
        `


    }
    currentIndex = end;
    if (currentIndex >= highlighList.response.length) {
        document.getElementById('loadBtnContainer').classList.add('d-none');
    }

    document.getElementById('highlight').innerHTML = content;



}



highlightSearch.addEventListener('input', function() {
    var content = ``;
    var highlightSearchVal = highlightSearch.value.toLowerCase();
    for (var index = 0; index < highlighList.response.length; index++) {
        if (highlighList.response[index].competition.toLowerCase().includes(highlightSearchVal) == true ||
            highlighList.response[index].title.toLowerCase().includes(highlightSearchVal) == true) {
            content +=
                `
                    <div class="single-highlight">
                        <p class="highlight-comp text-center">${highlighList.response[index].competition}</p>
                        <div class="highlight-vid">${highlighList.response[index].videos[0].embed}</div>
                        <p class="highlight-title text-center">${highlighList.response[index].title}</p>
                    </div>
                `
        }


    }
    document.getElementById('highlight').innerHTML = content;
});



document.getElementById('loadBtn').addEventListener('click', function() {
    increment = 4;
    displayHighlights();
});




// loadBtn.addEventListener('click', function() {
//     var btnContaiber = document.getElementById('loadBtnContainer');
//     var content = ``;
//     for (let index = 7; index < 13; index++) {
//         content +=
//             `
//             <div class="single-highlight">
//                 <p class="highlight-comp text-center">${highlighList.response[index].competition}</p>
//                 <div class="highlight-vid">${highlighList.response[index].videos[0].embed}</div>
//                 <p class="highlight-title text-center">${highlighList.response[index].title}</p>
//             </div>
//         `


//     }
//     document.getElementById('highlight').insertAdjacentHTML('beforeend', content);
//     btnContaiber.classList.add('d-none');


// });
</script>

@endsection
