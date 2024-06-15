let idCheck = 0;
document.addEventListener('DOMContentLoaded', function () {
    const Id = document.getElementById("user_id");

    const Pw = document.getElementById("user_pw");
    const c1 = document.getElementById("condition1");
    const c2 = document.getElementById("condition2");
    const c3 = document.getElementById("condition3");
    const i1 = c1.querySelector('i');
    const i2 = c2.querySelector('i');
    const i3 = c3.querySelector('i');

    const Pw_check = document.getElementById("pw_check");
    const pw_ns = document.getElementById("pw_noSame");

    const Email = document.getElementById("user_email");
    const em_ex = document.getElementById("email_existence");
    const em_v = document.getElementById("email_validator");

    const sb_btn = document.getElementById("signup_btn");

    // 조건이 맞는지 확인
    let f1 = 0;
    let f2 = 0;
    let f3 = 0;
    let f4 = 0;

    Pw.addEventListener('input', function () {
        validatePassword();
        if (Pw_check.value.length > 0) {
            validatePasswordCheck();
        }
    });

    Pw_check.addEventListener('input', validatePasswordCheck);

    Email.addEventListener('input', validateEmail);

    sb_btn.addEventListener('click', signup_check);

    function validatePassword() {
        const pw = Pw.value;
        let cf1 = 0;
        let cf2 = 0;
        let cf3 = 0;
        if (pw.length > 0) {
            const hasLetter = /[a-zA-Z]/.test(pw);
            const hasNumber = /[0-9]/.test(pw);
            const hasSpecial = /[^a-zA-Z0-9]/.test(pw);
            if (hasLetter && hasNumber && hasSpecial) {
                c1.style.color = 'green';
                i1.classList.remove('fa-xmark');
                i1.classList.add('fa-check');
                cf1 = 1;
            } else {
                c1.style.color = 'red';
                i1.classList.remove('fa-check');
                i1.classList.add('fa-xmark');
                cf1 = 0;
            }

            if (pw.length >= 8 && pw.length <= 30 && !/\s/.test(pw)) {
                c2.style.color = 'green';
                i2.classList.remove('fa-xmark');
                i2.classList.add('fa-check');
                cf2 = 1;
            } else {
                c2.style.color = 'red';
                i2.classList.remove('fa-check');
                i2.classList.add('fa-xmark');
                cf2 = 0;
            }

            const noThreeConsecutive = !/(.)\1\1/.test(pw);
            if (noThreeConsecutive) {
                c3.style.color = 'green';
                i3.classList.remove('fa-xmark');
                i3.classList.add('fa-check');
                cf3 = 1;
            } else {
                c3.style.color = 'red';
                i3.classList.remove('fa-check');
                i3.classList.add('fa-xmark');
                cf3 = 0;
            }
        }
        else {
            c1.style.color = '';
            c2.style.color = '';
            c3.style.color = '';
            i1.classList.remove('fa-check');
            i1.classList.add('fa-xmark');
            i2.classList.remove('fa-check');
            i2.classList.add('fa-xmark');
            i3.classList.remove('fa-check');
            i3.classList.add('fa-xmark');
            cf1 = cf2 = cf3 = 0;
        }
        if (cf1 == 1 && cf2 == 1 && cf3 == 1) {
            f2 = 1;
        }
        else {
            f2 = 0;
        }
        console.log(f2);
    }

    function validatePasswordCheck() {
        const pw = Pw.value;
        const pw_check = Pw_check.value;

        if (pw == pw_check && pw_check.length > 0) {
            pw_ns.style.display = 'none';
            f3 = 1;
        }
        else {
            pw_ns.style.display = 'block';
            f3 = 0;
        }
    }

    function validateEmail() {
        const email = Email.value;
        const emailPattern = /^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-za-z0-9\-]+/.test(email);

        if (!emailPattern && email.length > 0) {
            em_v.style.display = 'block';
            f4 = 0;
        }
        else {
            em_v.style.display = 'none';
            f4 = 1;
        }
    }

    function signup_check() {
        if (Id.value == '') {
            Id.style.border = '1px solid red';
            Id.focus();
            return;
        } else if (idCheck == 0) {
            Id.style.border = '1px solid red';
            Id.focus();
            document.getElementById("id_check").style.display = 'block';
            return;
        } else {
            Id.style.border = '';
            document.getElementById("id_check").style.display = 'none';
        }

        if (Pw.value == '' || f2 == 0) {
            Pw.style.border = '1px solid red';
            Pw.focus();
            return;
        } else {
            Pw.style.border = '';
        }

        if (Pw_check.value == '' || f3 == 0) {
            Pw_check.style.border = '1px solid red';
            Pw_check.focus();
            return;
        } else {
            Pw_check.style.border = '';
        }

        if (Email.value == '' || f4 == 0) {
            Email.style.border = '1px solid red';
            Email.focus();
            return;
        } else {
            Email.style.border = '';
        }

        document.querySelector('.form').submit();
    }
});

function checkId() {
    const id = document.getElementById("user_id");
    const id_ex = document.getElementById("id_existence");

    document.getElementById("id_check").style.display = 'none';

    if (id.value == '') {
        alert("아이디를 입력해주세요.");
        id.focus();
        return false;
    }

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let txt = xhr.responseText.trim();
                if (txt == "X") {
                    idCheck = 1;
                    id_ex.style.display = "none";
                    document.getElementById("id_available").style.display = 'block';
                    id.style.border = '1px solid gray';
                } else {
                    idCheck = 0;
                    id_ex.style.display = "block";
                    id.focus();
                }
            }
        }
    }
    xhr.open("GET", "/php/member/checkId.php?userId=" + id.value, true);
    xhr.send();
}