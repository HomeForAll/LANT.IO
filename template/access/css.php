<style>
    * {
        padding: 0;
        margin: 0;
    }

    body {
        background: url("/template/main/images/access_background.jpg") center center fixed no-repeat;
        background-size: cover;
    }

    #logo {
        position: relative;
        cursor: default;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        padding: 170px 0 0 0;
        color: #ffffff;
        font: 130pt 'Fedra Sense Pro Bold';
        text-align: center;
    }

    img {
        position: absolute;
        top: 325px;
        left: 50%;
        margin-left: -210px;
        width: 135px;
    }

    form {
        padding-top: 30px;
    }

    input::-moz-placeholder {
        color: #494949;
    }

    input::-webkit-input-placeholder {
        color: #494949;
    }

    input:-ms-input-placeholder {
        color: #494949;
    }

    input[type=text] {
        position: relative;
        left: 50%;
        font: 11pt 'Gotham Pro Regular';
        border: none;
        border-radius: 4px;
        outline: none;
        width: 350px;
        height: 10px;
        padding: 26px 20px 26px 90px;
        margin: 0 0 25px -230px;
    }

    #email {
        background: url("/template/main/images/msg.png") 33px 23px no-repeat #ffffff;
    }

    #emailError {
        border: solid 4px #c65555;
        width: 350px;
        height: 10px;
        padding: 22px 16px 22px 86px;
        margin: 0 0 25px -230px;
        background: url("/template/main/images/msg.png") 29px 19px no-repeat #ffffff;
    }

    #key {
        opacity: 0;
        padding: 26px 20px 26px 90px;
        margin: 0 0 0 -230px;
        height: 10px;
        background: url("/template/main/images/key.png") 30px 19px no-repeat #ffffff;
    }

    #keyError {
        border: solid 4px #c65555;
        width: 350px;
        height: 10px;
        padding: 22px 16px 22px 86px;
        margin: 0 0 25px -230px;
        background: url("/template/main/images/key.png") 26px 15px no-repeat #ffffff;
    }

    .keyVisible {
        margin: 0 auto 0 auto; /* 0 auto 25px auto */
        width: 460px;
        height: 0; /* 62px */
    }

    input[type=submit] {
        position: relative;
        cursor: pointer;
        left: 50%;
        color: #ffffff;
        border: none;
        outline: none;
        width: 460px;
        height: 65px;
        font: 18pt 'Gotham Pro Regular';
        border-radius: 4px;
        background: #4f85c8;
        margin: 0 0 0 -230px;

        -webkit-transition: background 0.25s;
        -moz-transition: background 0.25s;
        -o-transition: background 0.25s;
        transition: background 0.25s;
    }

    input[type=submit]:hover {
        background: #2f66aa;
    }

    a {
        font: 12pt 'Open Sans';
        color: #ffffff;
        text-decoration: none;
        opacity: 0.7;

        -webkit-transition: opacity 0.25s;
        -moz-transition: opacity 0.25s;
        -o-transition: opacity 0.25s;
        transition: opacity 0.25s;

    }

    a:hover {
        opacity: 1;
    }

    #link {
        padding: 40px 0;
        text-align: center;
    }

    #loading {
        background-color: #000;
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 999;
        margin-top: 0px;
        top: 0px;
    }

    #loading-center {
        width: 100%;
        height: 100%;
        position: relative;
    }

    #loading-center-absolute {
        position: absolute;
        left: 50%;
        top: 50%;
        height: 200px;
        width: 200px;
        margin-top: -100px;
        margin-left: -100px;

    }

    .object {
        -moz-border-radius: 50% 50% 50% 50%;
        -webkit-border-radius: 50% 50% 50% 50%;
        border-radius: 50% 50% 50% 50%;
        position: absolute;
        border-left: 5px solid #FFF;
        border-right: 5px solid #FFF;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
        -webkit-animation: animate 2s infinite;
        animation: animate 2s infinite;
    }

    #object_one {
        left: 75px;
        top: 75px;
        width: 50px;
        height: 50px;
    }

    #object_two {
        left: 65px;
        top: 65px;
        width: 70px;
        height: 70px;
        -webkit-animation-delay: 0.1s;
        animation-delay: 0.1s;
    }

    #object_three {
        left: 55px;
        top: 55px;
        width: 90px;
        height: 90px;
        -webkit-animation-delay: 0.2s;
        animation-delay: 0.2s;
    }

    #object_four {
        left: 45px;
        top: 45px;
        width: 110px;
        height: 110px;
        -webkit-animation-delay: 0.3s;
        animation-delay: 0.3s;

    }

    #rules {
        position: absolute;
        top: 20px;
        left: 50%;
        opacity: 0;
        visibility: hidden;
        margin-left: -385px;
        width: 770px;
        height: 860px;
        background: #FFFFFF;
        z-index: 999;
    }

    .rulesTitle {
        font: 15pt 'Gotham Pro Bold';
        padding: 75px 70px 45px 70px;
    }

    .rulesWrapper {
        overflow: hidden;
        margin: 0 auto;
        width: 630px;
        height: 500px;
    }

    .rulesBody {
        font: 10pt 'Gotham Pro Regular';
        line-height: 20px;
        width: 596px;
    }

    #buttons {
        position: relative;
        width: inherit;
        text-align: center;
    }

    #agree {
        display: block;
        margin: 30px auto 0 auto;
        font: 11pt 'Gotham Pro Regular';
        width: 150px;
        padding: 14px 45px 14px 45px;
        border-radius: 4px;
        opacity: 1;
        background: #75b668;

        -webkit-transition: background 0.25s;
        -moz-transition: background 0.25s;
        -o-transition: background 0.25s;
        transition: background 0.25s;
    }

    #agree:hover {
        background: #60a253;
    }

    #denial {
        display: block;
        font: 11pt 'Gotham Pro Regular';
        opacity: 0.3;
        margin-top: 35px;
        color: #000000;

        -webkit-transition: opacity 0.25s;
        -moz-transition: opacity 0.25s;
        -o-transition: opacity 0.25s;
        transition: opacity 0.25s;
    }

    #denial:hover {
        opacity: 1;
    }

    @-webkit-keyframes animate {

        50% {
            -ms-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        100% {
            -ms-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

    }

    @keyframes animate {

        50% {
            -ms-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        100% {
            -ms-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

    }
</style>