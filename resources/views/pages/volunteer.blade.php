@include('pages.common.header')

<style>
/* Temple Theme Styling */

.volunteer-section {
    background: linear-gradient(rgba(245,239,230,0.95), rgba(245,239,230,0.95)),
                url('{{ asset("assets/img/temple-pattern.png") }}');
    background-size: cover;
    padding: 80px 0;
}

.volunteer-heading {
    font-size: 32px;
    font-weight: 700;
    color: #b8860b;
    margin-bottom: 20px;
}

.volunteer-subtext {
    font-size: 16px;
    color: #555;
    line-height: 1.8;
}

.volunteer-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border-top: 5px solid #b8860b;
}

.volunteer-form input,
.volunteer-form textarea,
.volunteer-form select {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    padding: 12px;
    font-size: 14px;
}

.volunteer-form input:focus,
.volunteer-form textarea:focus,
.volunteer-form select:focus {
    border-color: #b8860b;
    box-shadow: 0 0 0 0.1rem rgba(184,134,11,0.25);
}

.volunteer-btn {
    background: linear-gradient(45deg, #b8860b, #d4af37);
    color: #fff;
    border: none;
    padding: 12px;
    font-weight: 600;
    border-radius: 8px;
    transition: 0.3s ease;
}

.volunteer-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.volunteer-icon-box {
    background: #fff8e7;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 15px;
    border-left: 4px solid #b8860b;
}
</style>

<div class="page-title page-title-inner padding-bottom9"
     style="background-image: url('{{ asset(optional($top)->voluntree ?? 'topbanner/Volunteer_Top.jpg') }}'); background-size: cover;">
     
    <div class="overlay-page-tile"></div>
    <div class="page-title-content">
        <div class="container">
            <div class="blog-title color-white">
                <h2 class="asas">श्री क्षिप्रेश्वर धाम</h2>
                
                <span style="color: #fff;">
    <a href="/" style="color: #fff;"> Home </a>
    » &nbsp;&nbsp;volunteer
</span>
            </div>
        </div>
    </div>
</div>
<!-- Volunteer Section -->
<section class="volunteer-section">
<div class="container">
<div class="row align-items-center">

<!-- Left Side Content -->
<div class="col-lg-6 mb-4">

    <h2 class="volunteer-heading">
        सेवा के लिए स्वयंसेवक पंजीकरण
    </h2>

    <p class="volunteer-subtext">
        जो भक्तजन आने वाले कार्यक्रमों में सेवा देना चाहते हैं,
        कृपया नीचे दिया गया फॉर्म भरें।
        आपकी सेवा ही सच्ची भक्ति है।
    </p>

    <div class="volunteer-icon-box">
        🙏 धार्मिक कार्यक्रमों में सेवा
    </div>

    <div class="volunteer-icon-box">
        🛕 मंदिर व्यवस्था में सहयोग
    </div>

    <div class="volunteer-icon-box">
        🍛 भंडारा एवं प्रसाद सेवा
    </div>

</div>


<!-- Right Side Form -->
<div class="col-lg-6">
<div class="volunteer-card">

<form id="volunteerForm" class="volunteer-form">
@csrf

<div class="row">

<div class="col-md-6 mb-3">
    <input type="text" name="full_name" class="form-control"
           placeholder="पूरा नाम *" required>
</div>

<div class="col-md-6 mb-3">
    <input type="text" name="mobile" class="form-control"
           placeholder="मोबाइल नंबर *" required>
</div>

<div class="col-md-6 mb-3">
    <input type="email" name="email" class="form-control"
           placeholder="ईमेल *" required>
</div>

<div class="col-md-6 mb-3">
    <select name="gender *" class="form-control" required>
        <option value="">लिंग चुनें</option>
        <option value="Male">पुरुष</option>
        <option value="Female">महिला</option>
    </select>
</div>
<div class="col-md-6 mb-3">
<select name="event_id" class="form-control" required>
    <option value="">इवेंट चुनें *</option>

    @foreach($events as $event)
        <option value="{{ $event->id }}">
            {{ $event->event_name }}
        </option>
    @endforeach

</select>
</div>

<div class="col-md-6 mb-3">
    <input type="number" name="age" class="form-control"
           placeholder="आयु *" required>
</div>

<div class="col-md-12 mb-3">
    <input type="text" name="city" class="form-control"
           placeholder="शहर *" required>
</div>

<div class="col-md-12 mb-3">
    <textarea name="address" class="form-control"
              placeholder="पूरा पता *" required></textarea>
</div>

<div class="col-md-12 mb-3">
    <textarea name="experience" class="form-control"
              placeholder="पूर्व सेवा अनुभव (यदि हो *)" required></textarea>
</div>

<div class="col-12">
<button type="submit" class="volunteer-btn w-100">
    सेवा हेतु आवेदन भेजें
</button>
</div>

</div>
</form>

</div>
</div>

</div>
</div>
</section>

@include('pages.common.footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){

    $('#volunteerForm').on('submit', function(e){
        e.preventDefault();

        let formData = new FormData(this);

        Swal.fire({
            title: 'Processing...',
            text: 'कृपया प्रतीक्षा करें',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "{{ route('volunteer.submit') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response){

                Swal.fire({
                    icon: 'success',
                    title: 'धन्यवाद 🙏',
                    text: response.message,
                    confirmButtonColor: '#b8860b'
                });

                $('#volunteerForm')[0].reset();
            },
            error: function(xhr){

                Swal.fire({
                    icon: 'error',
                    title: 'त्रुटि',
                    text: 'कुछ समस्या आई है, कृपया पुनः प्रयास करें।',
                    confirmButtonColor: '#b8860b'
                });

            }
        });

    });

});
</script>