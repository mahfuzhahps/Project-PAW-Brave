
document.addEventListener("DOMContentLoaded", function () {

    const toggleButtons = document.querySelectorAll(
        "[data-toggle-password]"
    );

    toggleButtons.forEach(function (button) {

        const targetId = button.dataset.target;
        const input = document.getElementById(targetId);
        const icon = button.querySelector("[data-eye-icon]");

        if (!input) return;

        const eyeIcon = icon ? icon.dataset.eyeVisible : null;
        const eyeOffIcon = icon ? icon.dataset.eyeHidden : null;

        function updatePasswordToggle() {
            const isVisible = input.type === "text";
            if (icon) {
                const nextIcon = isVisible ? eyeOffIcon : eyeIcon;
                if (nextIcon) {
                    icon.src = nextIcon;
                }
            }

            button.setAttribute(
                "aria-pressed",
                String(isVisible)
            );

            button.setAttribute(
                "aria-label",
                isVisible
                    ? "Sembunyikan password"
                    : "Tampilkan password"
            );
        }

        button.addEventListener("click", function (event) {
            event.preventDefault();
            input.type = input.type === "text"
                ? "password"
                : "text";
            updatePasswordToggle();
        });
        updatePasswordToggle();
    });

    const passwordInput = document.getElementById("password");
    const strengthMeter = document.querySelector(
        "[data-strength-meter]"
    );
    if (passwordInput && strengthMeter) {
        function calculatePasswordStrength(password) {
            if (!password) return 0;
            let score = 0;
            if (password.length >= 8) score++;
            if (/[a-zA-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (
                password.length >= 12 ||
                /[^a-zA-Z0-9]/.test(password)
            ) {
                score++;
            }
            return Math.min(score, 4);
        }

        function updateStrengthMeter() {
            const password = passwordInput.value;
            const strength = calculatePasswordStrength(password);
            strengthMeter.dataset.level = strength;
        }

        passwordInput.addEventListener(
            "input",
            updateStrengthMeter
        );
        updateStrengthMeter();
    }

    const form = document.getElementById("register-form");
    if (!form) return;
    const fields = {
        name: document.getElementById("name"),
        email: document.getElementById("email"),
        password: document.getElementById("password"),
        confirmation: document.getElementById(
            "password_confirmation"
        )
    };

    const errorElements = {
        name: document.getElementById("name-error"),
        email: document.getElementById("email-error"),
        password: document.getElementById("password-error"),
        confirmation: document.getElementById(
            "confirmation-error"
        )
    };

    const submitButton = form.querySelector(
        "[data-submit-button]"
    );

    const submitLabel = form.querySelector(
        "[data-submit-label]"
    );

    const submitSpinner = form.querySelector(
        "[data-submit-spinner]"
    );

    const submitArrow = form.querySelector(
        "[data-submit-arrow]"
    );

    const processingMessage = form.querySelector(
        "[data-processing-message]"
    );

    const systemError = document.getElementById(
        "register-system-error"
    );

    const systemErrorMessage = document.getElementById(
        "register-system-error-message"
    );

    const successModal = document.getElementById(
        "register-success-modal"
    );

    const successContinue = document.getElementById(
        "register-success-continue"
    );

    let submitAttempted = false;
    let requestInProgress = false;
    const touchedFields = new Set();

    function showFieldError(fieldName, message) {
        const input = fields[fieldName];
        const errorElement = errorElements[fieldName];
        if (!input || !errorElement) return;
        errorElement.textContent = message || "";
        errorElement.hidden 
        input.classList.toggle(
            "is-invalid",
            Boolean(message)
        );

        if (message) {
            input.setAttribute(
                "aria-invalid",
                "true"
            );
        } else {
            input.removeAttribute("aria-invalid");
        }
    }

    function validateField(fieldName) {
        const input = fields[fieldName];
        if (!input) return true;
        const value = input.value;
        let message = "";
        switch (fieldName) {
            case "name":
                if (!value.trim()) {
                    message = "Nama lengkap wajib diisi."
                } else if (value.trim().length > 255) {
                    message = "Nama lengkap maksimal 255 karakter.";
                }
                break;

            case "email":
                if (!value.trim()) {
                    message = "Email wajib diisi.";
                } else if (value.trim().length > 255) {
                    message = "Email maksimal 255 karakter.";
                } else if (
                    !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(value.trim())
                ) {
                    message = "Masukkan alamat email dengan format yang benar.";
                }
                break;

            case "password":
                if (!value) {
                    message = "Password wajib diisi.";
                } else if (value.length < 8) {
                    message = "Password minimal 8 karakter.";
                } else if (!/[a-zA-Z]/.test(value)) {
                    message = "Password wajib mengandung minimal 1 huruf.";
                } else if (!/[0-9]/.test(value)) {
                    message = "Password wajib mengandung minimal 1 angka.";
                }
                break;

            case "confirmation":
                if (!value) {
                    message = "Konfirmasi password wajib diisi.";
                } else if (
                    value !== fields.password.value
                ) {
                    message = "Konfirmasi password tidak sesuai.";
                }
                break;
        }
        showFieldError(fieldName, message);
        return !message;
    }

    Object.entries(fields).forEach(function ([fieldName, input]) {
        if (
            input &&
            input.getAttribute("aria-invalid") === "true"
        ) {
            touchedFields.add(fieldName);
        }
    });

    Object.entries(fields).forEach(function ([fieldName, input]) {
        if (!input) return;
        input.addEventListener("blur", function () {
            touchedFields.add(fieldName);
            validateField(fieldName);
        });

        input.addEventListener("input", function () {
            if (
                touchedFields.has(fieldName) ||
                submitAttempted
            ) {
                validateField(fieldName);
            }

            if (
                fieldName === "password" &&
                (
                    touchedFields.has("confirmation") ||
                    submitAttempted
                )
            ) {
                validateField("confirmation");
            }
        });
    });

    function setSubmitState(state) {
        if (!submitButton || !submitLabel) return;
        if (state === "processing") {
            submitButton.disabled = true;
            submitButton.setAttribute(
                "aria-busy",
                "true"
            );

            submitButton.dataset.state = "processing";
            submitLabel.textContent = "Memproses...";
            if (submitSpinner) {
                submitSpinner.hidden = false;
            }

            if (submitArrow) {
                submitArrow.hidden = true;
            }

            if (processingMessage) {
                processingMessage.hidden = false;
            }

            return;
        }

        submitButton.disabled = false;
        submitButton.removeAttribute("aria-busy");
        submitButton.dataset.state = state;
        submitLabel.textContent = state === "retry"
            ? "Coba Lagi"
            : "Daftar";

        if (submitSpinner) {
            submitSpinner.hidden = true;
        }

        if (submitArrow) {
            submitArrow.hidden = false;
        }

        if (processingMessage) {
            processingMessage.hidden = true;
        }
    }

    function showSystemError(message) {
        if (systemErrorMessage && message) {
            systemErrorMessage.textContent = message;
        }

        if (systemError) {
            systemError.hidden = false;
        }
        setSubmitState("retry");
    }

    function hideSystemError() {
        if (systemError) {
            systemError.hidden = true;
        }
    }

    function openSuccessModal() {
        if (!successModal) return;
        successModal.hidden = false;
        document.body.classList.add("br-modal-open");
        if (successContinue) {
            successContinue.focus();
        }
    }

    function displayServerValidationErrors(errors) {
        const keyMap = {
            name: "name",
            email: "email",
            password: "password",
            password_confirmation: "confirmation"
        };

        Object.keys(fields).forEach(function (fieldName) {
            showFieldError(fieldName, "");
        });

        let firstInvalidInput = null;
        Object.entries(errors || {}).forEach(function ([serverKey, messages]) {
            const fieldName = keyMap[serverKey];
            if (!fieldName) return;
            const message = Array.isArray(messages)
                ? messages[0]
                : String(messages);
            showFieldError(fieldName, message);
            touchedFields.add(fieldName);

            if (!firstInvalidInput) {
                firstInvalidInput = fields[fieldName];
            }
        });

        if (firstInvalidInput) {
            firstInvalidInput.focus();
        }
        return Boolean(firstInvalidInput);
    }

    async function submitRegistration() {
        if (requestInProgress) return;
        requestInProgress = true;
        hideSystemError();
        setSubmitState("processing");

        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        )?.content;

        try {
            const response = await fetch(form.action, {
                method: "POST",
                credentials: "same-origin",
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrfToken || ""
                },
                body: new FormData(form)
            });

            let responseData = null;
            try {
                responseData = await response.json();
            } catch (parseError) {
                responseData = null;
            }

            if (response.status === 422) {
                const hasFieldErrors = displayServerValidationErrors(
                    responseData?.errors || {}
                );

                if (!hasFieldErrors) {
                    showSystemError(
                        "Data belum dapat diproses. Periksa kembali isian Anda dan coba lagi."
                    );
                } else {
                    hideSystemError();
                    setSubmitState("default");
                }
                return;
            }

            if (!response.ok) {
                throw new Error(
                    `Registration request failed with status ${response.status}`
                );
            }

            if (responseData?.success === true) {
                setSubmitState("default");
                hideSystemError();
                openSuccessModal();
                return;
            }

            throw new Error(
                "The server response did not confirm registration success."
            );

        } catch (error) {

            console.error(
                "BRAVE registration error:",
                error
            );

            showSystemError(
                "Pendaftaran belum berhasil. Terjadi gangguan pada sistem. Silakan coba lagi."
            );

        } finally {
            requestInProgress = false;
        }
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        if (requestInProgress) return;
        submitAttempted = true;

        const validationOrder = [
            "name",
            "email",
            "password",
            "confirmation"
        ];

        let firstInvalidInput = null;
        validationOrder.forEach(function (fieldName) {
            const isValid = validateField(fieldName);
            touchedFields.add(fieldName);

            if (
                !isValid &&
                !firstInvalidInput
            ) {

                firstInvalidInput = fields[fieldName];
            }
        });

        if (firstInvalidInput) {
            firstInvalidInput.focus();
            return;
        }
        submitRegistration();
    });
});