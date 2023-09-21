<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Certification</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="cert-letter-styles.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="cert-container">
        <div class="border-gray">
            <div class="border-red">
                <div class="content">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo-dark" />
                    <img id="mt-stamp" src="{{ asset('assets/images/stamp.jpg') }}" alt="Certified Stamp" />

                    <div class="copytext-container">
                        <div class="congrats-copytext">
                            <h1>Certificate of Completion</h1><br>
                            <h2>Congratulations <span>{{$user->firstname}}</span><span> {{$user->lastname}}</span></h2><br>
                        </div>

                        <div class="course-copytext">
                            <h1><span>{{ $course->name }}</span></h1><br>
                            <p><span>{{ $course->description }}</span></p><br>
                            <h2>Course Completed on: <span>{{ Carbon\Carbon::parse($test->ends_at)->format('d M, Y') }}</span></h2><br>

                        </div>
                        <div class="address-copytext">
                            <address>Redcross Society <br> Fiji <br> </address>
                            <a href="#" id="mt-site"><em>redcross-fiji.com</em></a>
                        </div>
                    </div>
                    <a class="pbtn" onclick="{this.style.display = 'none'; window.print();}"> Print </a>
                </div>
            </div>
        </div>
    </div>

</body>
<style>
    @charset "UTF-8";

    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;1,400&display=swap');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
    }

    .pbtn {
        float: right;
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 1%;
        font-size: 16px;
    }

    a {
        color: black;
        text-decoration: none;
    }


    address {
        font-weight: 100;
        font-size: 14pt;
        font-style: normal;
        line-height: 135%;
    }

    h2,
    h3 {
        font-weight: 300
    }

    ul {
        color: #58595B;
        text-decoration: none;
        list-style-type: none;
        font-size: 9pt;
        font-weight: 300;
        text-align: right
    }

    .cert-container {
        position: relative;
        padding: 45px;
        border: 1px solid #6f6f6f;
        width: 1056px;
        height: 816px;
        background-image: url(images/mt_icon_grayscale.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        margin: auto;
    }

    /* Certificate Outer Border (Gray) */
    .border-gray {
        padding: 5px;
        border: 3px solid #58595B;
    }

    /* Certificate Inner Border (red) */
    .border-red {
        border: 3px double #CE202F;
    }

    .content {
        padding: 20px;
        height: 700px;
        text-align: center;
    }

    /* Certificate, Host Server, and LMS IDs */
    .credentials {
        position: absolute;
        right: 100px;
        top: 120px;
    }

    .copytext-container {
        position: absolute;
        left: 190px;
        top: 275px;
        text-align: left;
        line-height: 100%;
    }

    .congrats-copytext {
        margin-bottom: 70px;
    }

    .course-copytext {
        margin-bottom: 65px;
    }

    .address-copytext {
        line-height: 150%;
    }

    #mt-logo {
        position: absolute;
        width: 350px;
        right: 610px;
        top: 105px;
    }

    #mt-stamp {
        position: absolute;
        width: 144px;
        right: 130px;
        top: 550px;
    }

    #mt-site {
        color: #CE202F;
        font-size: 14pt;

    }

    #user-id-string {
        line-height: 7px;
    }

    #course-id-string {
        line-height: 7px;
    }

    @media print {
        @page {
            size: letter landscape;
            margin: 0;
            padding: 0;
        }

        .cert-container {
            border: none;
        }

        /*  
  background-image {
    image-resolution: 300dpi;
    }
*/
    }
</style>

</html>