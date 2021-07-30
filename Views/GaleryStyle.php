<style>


    body {
        font-family: Arial;
        margin: 0;
    }

    * {
        box-sizing: border-box;
    }

    img {
        vertical-align: middle;
    }

    /* Position the image container (needed to position the left and right arrows) */
    .container {
        display: inline-block;
        position: relative;
        width: 600px;
        border: #7e7e7e 1px solid;
        padding: 3px;
        margin-left: 10px;
    }

    /* Hide the images by default */
    .mySlides {
        display: none;
    }

    /* Add a pointer when hovering over the thumbnail images */
    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* Container for image text */
    .caption-container {
        text-align: center;
        background-color: #222;
        padding: 2px 16px;
        color: white;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Six columns side by side */
    .column {
        float: left;
        width: 16.66%;
    }

    /* Add a transparency effect for thumnbail images */
    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    .contentViewPage
    {
        background-color: rgba(10, 10, 10, 0.6);
        display: block;
        width: 1000px;
        margin-left: auto;
        margin-right: auto;
        border-left: #cbcbcb 1px solid;
        border-right: #cbcbcb 1px solid;
    }

    .mainPart
    {
        margin-top:6vh;
        padding-top: 2vh;
        padding-bottom: 4.5vh;
    }

    .baseInfo
    {
        border-bottom: #727272 1px solid;
        margin-bottom: 5px;
        padding-bottom: 5px;
    }

    .carNameView
    {
        font-family: Century Gothic, serif;
        font-size: 40px;
        margin-left: 10px;
        color: #e2e2e2;
    }

    .priceView
    {
        font-family: Century Gothic, serif;
        font-size: 40px;
        color: #9bff89;
        float: right;
        margin-right: 10px;
    }

    .imagesSpecs
    {
        padding-bottom: 5px;
        border-bottom: #727272 1px solid;
    }

    .Specs
    {
        display: inline-block;
        position: absolute;
        font-family: Century Gothic, serif;
        font-size: 30px;
        color: #d6d6d6;
        margin: 10px 15px;
    }

    .Specs td
    {
        font-family: Century Gothic, serif;
        font-size: 20px;
        color: #d6d6d6;
        padding-right: 15px;
    }

    .descName
    {
        font-family: Century Gothic, serif;
        font-size: 30px;
        color: #d6d6d6;
        margin-left: 10px;
    }

    .description
    {
        font-family: Century Gothic, serif;
        font-size: 20px;
        color: #d6d6d6;
        margin-left: 10px;
    }

    .descContainer
    {
        margin: 10px 20px;
    }

    .buyButton
    {
        display: inline-block;

        border: #a9ff7a 1px solid;
        padding: 15px;

        background-color: #1a1a1a;
    }

    .buyButton a
    {
        font-family: Century Gothic, serif;
        font-size: 20px;
        color: #87be70;
        text-decoration: none;
    }

    .buyButton a:hover
    {
        color: #d5ffba;
    }
</style>
