<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <link href="{{asset('website-assets/css/home.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="home_main_div">
        <div class="home_cover_css">
            <div class="d-flex justify-content-between align-items-center px-3 pt-2"> 
                <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
                <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" />             
            </div>
            <div class="d-flex justify-content-between align-items-center px-3" style="padding-top:60px; margin-top: 60px;">
                <div>
                    <img src="{{asset('website-assets/image/cm.png')}}" alt="logo"/>
                    <h5 class="name_deading">
                        श्री योगी आदित्यनाथ</h5>
                    <small class="name_sub_deading">
                        <p class="mb-0">माननीय मुख्यमंत्री</p>
                        <p class="mb-0">उत्तर प्रदेश</p>
                    </small>
                </div>
                <div>
                    <img src="{{asset('website-assets/image/jaiveer-singh.png')}}" alt="logo"/>
                    <h5 class="name_deading">श्री जयवीर सिंह</h5>
                    <small class="name_sub_deading">
                        <p class="mb-0"> माननीय मंत्री</p>
                        <p class="mb-0">संस्कृति विभाग,</p>
                        <p class="mb-0">उत्तर प्रदेश</p>
                    </small>
                </div>
            </div>
            <div class="home_content_css">
                <div class="home_content_div">
                    <div>
                        <p class="home_langauge_css">Language - <span class="home_langauge_text">
                                <a href="{{route('welcome')}}" class="home_langauge_text">हिंदी</a>
                                <a href="{{route('welcome')}}" class="home_langauge_text">English</a>
                                <a href="{{route('welcome')}}" class="home_langauge_text">தமிழ்</a>
                                <a href="{{route('welcome')}}" class="home_langauge_text">ಕನ್ನಡ</a>
                                <a href="{{route('welcome')}}" class="home_langauge_text">తెలుగు</a>
                                <a href="{{route('welcome')}}" class="home_langauge_text">മലയാളം</a>
                            </span></p>
                    </div>
                    <p class="home_sponsor">Sponsorship by - <img src="{{asset('website-assets/image/icic.png')}}" /></p>
                </div>

            </div>
            <div class="footer_border">
                <p class="footer_css"><a href="https://www.softgentech.com/"
                        class="footer_css text-decoration-none" target="_blank">Designed
                        and Developed By Softgen Technologies Pvt Ltd</a></p>
            </div>
        </div>
    </div>
</body>

</html>