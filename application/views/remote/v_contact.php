<div class="card card-fixed mb-n5" data-card-height="350">
    <div class="map-full">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7752.21419129856!2d100.53175743151235!3d13.711963008377886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f1a3d1745ab%3A0xe53e4bdad87508ca!2z4Liq4Lig4Liy4Lit4Li44LiV4Liq4Liy4Lir4LiB4Lij4Lij4Lih4LmB4Lir4LmI4LiH4Lib4Lij4Liw4LmA4LiX4Lio4LmE4LiX4Lii!5e0!3m2!1sth!2sth!4v1645383079989!5m2!1sth!2sth" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
<div class="card card-clear" data-card-height="350"></div>

<div class="page-content pb-3">

    <div class="card card-full rounded-m pb-4">
        <div class="drag-line"></div>

        <div class="content">
            <p class="font-600 mb-n1 color-highlight">We're here</p>
            <h1>ติดต่อเรา</h1>
            <p>
                กรอกแบบฟอร์มสำหรับติดต่อสถาบัน
            </p>

            <div class="formValidationError bg-red-dark mb-4 rounded-sm shadow-xl" id="contactNameFieldError">
                <p class="text-center text-uppercase p-2 color-white font-900 ">Name is required!</p>
            </div>
            <div class="formValidationError bg-red-dark mb-4 rounded-sm shadow-xl" id="contactEmailFieldError">
                <p class="text-center text-uppercase p-2 color-white font-900">Mail address required!</p>
            </div>
            <div class="formValidationError bg-red-dark mb-4 rounded-sm shadow-xl" id="contactEmailFieldError2">
                <p class="text-center text-uppercase p-2 color-white font-900">Mail address must be valid!</p>
            </div>
            <div class="formValidationError bg-red-dark mb-4 rounded-sm shadow-xl" id="contactMessageTextareaError">
                <p class="text-center text-uppercase p-2 color-white font-900">Message field is empty!</p>
            </div>

            <div class="formSuccessMessageWrap card card-style">
                <div class="shadow-l rounded-m bg-gradient-green1 mr-n1 ml-n1 mb-n1 ">
                    <h1 class="color-white text-center pt-4"><i class="fa fa-check-circle fa-3x shadow-s scale-box rounded-circle"></i></h1>
                    <h2 class="color-white bold text-center pt-3">Message Sent</h2>
                    <p class="color-white pb-4 text-center mt-n2 mb-0">We'll get back to you shortly.</p>
                </div>
            </div>

            <div class="formSuccessMessageWrap card card-style">
                <div class="content text-center">
                    <h2>Meanwhile, let's get social!</h2>
                    <p class="boxed-text-xl">
                        Here are our social media platforms! Follow us for the latest updates or just say hello!
                    </p>
                    <a href="#" class="icon icon-xl shadow-xl rounded-xl bg-facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="icon icon-xl shadow-xl rounded-xl bg-instagram ml-3 mr-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="icon icon-xl shadow-xl rounded-xl bg-twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <form action="php/contact.php" method="post" class="contactForm" id="contactForm">
                <fieldset>
                    <div class="form-field form-name">
                        <label class="contactNameField color-theme" for="contactNameField">ชื่อ :<span>(ต้องกรอก)</span></label>
                        <input type="text" name="contactNameField" value="" class="contactField round-small requiredField" id="contactNameField" />
                    </div>
                    <div class="form-field form-email">
                        <label class="contactEmailField color-theme" for="contactEmailField">อีเมล์ :<span>(ต้องกรอก)</span></label>
                        <input type="text" name="contactEmailField" value="" class="contactField round-small requiredField requiredEmailField" id="contactEmailField" />
                    </div>
                    <div class="form-field form-text">
                        <label class="contactMessageTextarea color-theme" for="contactMessageTextarea">ข้อความ :<span>(ต้องกรอก)</span></label>
                        <textarea name="contactMessageTextarea" class="contactTextarea round-small requiredField" id="contactMessageTextarea"></textarea>
                    </div>
                    <div class="form-button">
                        <input type="submit" class="btn gradient-highlight text-uppercase font-600 font-12 btn-full rounded-s  shadow-xl contactSubmitButton" value="ส่งข้อความ" data-formId="contactForm" />
                    </div>
                </fieldset>
            </form>

            <div class="divider mt-4"></div>

            <h3 class="font-700">ที่อยู่ติดต่อ</h3>
            <p class="pb-0 mb-0">สถาบันน้ำและสิ่งแวดล้อมเพื่อความยั่งยืน</p>
            <p class="pb-0">
            สภาอุตสาหกรรมแห่งประเทศไทย</br>
            ชั้น 7 อาคารปฏิบัติการเทคโนโลยีเชิงสร้างสรรค์ เลขที่ 2 ถนนนางลิ้นจี่</br>
            แขวงทุ่งมหาเมฆ (มทรก.) </br>เขตสาทร </br>กรุงเทพมหานคร 10120</p>

            <div class="divider"></div>

            <div class="list-group list-custom-small">
                <a href="tel:+1 234 567 890">
                    <i class="fa font-14 fa-phone color-phone"></i>
                    <span>02-345-1257, 02-345-1267</span>
                    <span class="badge bg-highlight">โทรศัพท์</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="mailto:mail@domain.com">
                    <i class="fa font-14 fa-envelope color-mail"></i>
                    <span>ecofactory.fti@gmail.com</span>
                    <span class="badge bg-highlight">อีเมล์</span>
                    <i class="fa fa-angle-right"></i>
                </a>

            </div>


        </div>
    </div>

</div>