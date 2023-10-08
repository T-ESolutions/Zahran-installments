<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="html5,css3">
    <meta name="author" content="TES">
    <meta name="description" content="Trust Receipt">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;800&display=swap" rel="stylesheet">
    <title>Trust Receipt</title>
</head>

<body style="direction: rtl; font-family: 'Cairo', sans-serif; padding: 0; margin: 0;">
<!-- start home -->
<section class="home" style="padding: 20px; ">
    <div class="content" style="padding: 30px 20px; border: 1px solid #000;">
        <div>
            <header>
                <h1 style="text-align: center; font-size: 30px; font-weight: bold; ">إيصال أمانة</h1>
            </header>
            <article style="padding: 0 30px;">
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;">استلمت انا الموقع ادناه / <span> {{$customer->name}}</span>
                    </p>
                    <p style="font-size: 22px; margin: 0;"> بطاقة رقم / <span> {{$customer->id_number}} </span></p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-evenly; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> المقيم / <span> {{$customer->address_id}} </span></p>
                    <p style="font-size: 22px; margin: 0;"> مركز / <span> {{$customer->center}}  </span></p>
                    <p style="font-size: 22px; margin: 0;"> محافظة / <span> {{$customer->governorate}} </span></p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> من السيد / <span> {{settings('first_name')}} </span></p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> مبلغ وقدره / <span> {{settings('check_amount')}} جنيها مصريا فقط لا غير </span>
                    </p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;">  وذلك على سبيل الأمانة لتوصيله للسيد / <span> {{settings('first_name')}} </span></p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> وإذا لم اقم بتوصيل هذا المبلغ أكون خائنا للأمانة ومبددا
                        لهذا المبلغ واكون مسؤولا عن ذلك مسئوليه مدنيه وجنائية. </p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: flex-end; align-items: center; padding: 5px 0;">
                    <div class="receive" style="min-width: 500px;">
                        <h3 style="text-align: center; font-weight: 600;">المستلم</h3>
                        <ul style="list-style-type: none;">
                            <li>
                                <p style="font-size: 22px; margin: 0;"> الاسم / <span> .............................
                                        </span></p>
                            </li>
                            <li>
                                <p style="font-size: 22px; margin: 0;"> التوقيع / <span>
                                            ............................. </span></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row" style="padding: 30px 0;">
                    <hr style="height: 2px; background-color: #000;">
                    <hr style="height: 2px; background-color: #000;">
                    <hr style="height: 2px; background-color: #000;">
                </div>

            </article>
        </div>
        <div>
            <header>
                <h1 style="text-align: center; font-size: 30px; font-weight: bold; ">إيصال أمانة</h1>
            </header>
            <article style="padding: 0 30px;">
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;">استلمت انا الموقع ادناه / <span> {{$customer->name}}</span>
                    </p>
                    <p style="font-size: 22px; margin: 0;"> بطاقة رقم / <span> {{$customer->id_number}} </span></p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-evenly; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> المقيم / <span> {{$customer->address_id}} </span></p>
                    <p style="font-size: 22px; margin: 0;"> مركز / <span> {{$customer->center}} </span></p>
                    <p style="font-size: 22px; margin: 0;"> محافظة / <span> {{$customer->governorate}} </span></p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> من السيد / <span> {{settings('second_name')}} </span></p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> مبلغ وقدره / <span> {{settings('check_amount')}} جنيها مصريا فقط لا غير </span>
                    </p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> وذلك على سبيل الأمانة لتوصيله للسيد / <span>{{settings('second_name')}} </span></p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                    <p style="font-size: 22px; margin: 0;"> وإذا لم اقم بتوصيل هذا المبلغ أكون خائنا للأمانة ومبددا
                        لهذا المبلغ واكون مسؤولا عن ذلك مسئوليه مدنيه وجنائية. </p>
                </div>
                <div class="row"
                     style="display: flex; justify-content: flex-end; align-items: center; padding: 5px 0;">
                    <div class="receive" style="min-width: 500px;">
                        <h3 style="text-align: center; font-weight: 600;">المستلم</h3>
                        <ul style="list-style-type: none;">
                            <li>
                                <p style="font-size: 22px; margin: 0;"> الاسم / <span> .............................
                                        </span></p>
                            </li>
                            <li>
                                <p style="font-size: 22px; margin: 0;"> التوقيع / <span>
                                            ............................. </span></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
<!-- end home -->
</body>

<script>
    // JavaScript code for removing links before printing
    window.onload = function() {
        // Select all anchor (link) elements on the page
        var links = document.querySelectorAll('a');

        // Loop through the links and remove them
        for (var i = 0; i < links.length; i++) {
            links[i].parentNode.removeChild(links[i]);
        }

        // Trigger the print dialog after removing links
        window.print();
    };
</script>

</html>
