jQuery(document).ready(function ($) {
  $(".show-password").click(function () {

    //Скрытие и показ пароля
    const passwordInput = $(".contact-password");
    $(this).toggleClass("active");

    if (passwordInput.attr("type") === "password") {
      passwordInput.attr("type", "text");
    } else {
      passwordInput.attr("type", "password");
    }
  });

  //Стрелка select, открытие и закрытие
  $(".city-block").click(function (event) {
    $(this).toggleClass("active");
    event.stopPropagation();
  });

  $(".city").focusout(function () {
    $(".city-block").removeClass("active");
  });

    //Сабмит формы
  $(".contact-form").submit(function (e) {
    e.preventDefault();
    if (validateForm()) {
      let form_data = $(this).serialize();

      $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: form_data,
        success: function (response) {
          console.log(response);
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });

  //Валидация формы
  function validateForm() {
    let isValid = true;

    const name = document.querySelector(".contact-name");
    const email = document.querySelector(".contact-mail");
    const phone = document.querySelector(".contact-phone");
    const password = document.querySelector(".contact-password");
    const passwordBlock = document.querySelector(".password-block");
    const city = document.querySelector(".city");
    const privacyCheckbox = document.getElementById("privacy");
    const phonePattern = /^(?:\+380|0)\d{9}$/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const nameError = document.getElementById("name-error");
    const emailError = document.getElementById("email-error");
    const phoneError = document.getElementById("phone-error");
    const passwordError = document.getElementById("password-error");
    const cityError = document.getElementById("city-error");
    const privacyError = document.getElementById("privacy-error");

    nameError.innerHTML = "";
    emailError.innerHTML = "";
    phoneError.innerHTML = "";
    cityError.innerHTML = "";
    passwordError.innerHTML = "";
    privacyError.innerHTML = "";

    //Проверка пустого имени
    if (name.value.trim() === "") {
      nameError.innerHTML = "Please enter your name";
      name.classList.add("error");
      isValid = false;
    } else {
      name.classList.remove("error");
    }

    //Проверка пустой почты и правильности ввода
    if (email.value.trim() === "") {
      emailError.innerHTML = "Please enter your email";
      email.classList.add("error");
      isValid = false;
    } else if (!emailPattern.test(email.value.trim())) {
      emailError.innerHTML = "Please enter a valid email address";
      email.classList.add("error");
      isValid = false;
    } else {
      email.classList.remove("error");
    }

    //Проверка пустого поля телефона и правильности ввода
    if (phone.value.trim() === "") {
      phoneError.innerHTML = "Please enter your phone number";
      phone.classList.add("error");
      isValid = false;
    } else if (!phonePattern.test(phone.value.trim())) {
      phoneError.innerHTML =
        "Please enter a valid phone number, exapmle: +380999999999";
      phone.classList.add("error");
      isValid = false;
    } else {
      phone.classList.remove("error");
    }

    //Проверка пустого поля пароля и количества символов
    if (password.value.trim() === "") {
      passwordError.innerHTML = "Please enter your password";
      password.classList.add("error");
      passwordBlock.classList.add("error");
      isValid = false;
    } else if (password.value.length < 8) {
      passwordError.innerHTML = "Password must be at least 8 characters long";
      password.classList.add("error");
      passwordBlock.classList.add("error");
      isValid = false;
    } else {
      password.classList.remove("error");
      passwordBlock.classList.remove("error");
    }

    //Проверка селекта выбора города
    if (city.value === "") {
      cityError.innerHTML = "Please choose your city";
      city.classList.add("error");
      isValid = false;
    } else {
      city.classList.remove("error");
    }
    if (!privacyCheckbox.checked) {
      privacyError.innerHTML = "Please accept the privacy policy";
      isValid = false;
    }

    return isValid;
  }
});
