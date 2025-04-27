document.addEventListener("DOMContentLoaded", function () {
  // Track form submission status
  let isSubmitting = false;

  function showNotification(message, type = "error") {
    const existingNotification = document.querySelector(".custom-notification");
    if (existingNotification) {
      existingNotification.remove();
    }

    const notification = document.createElement("div");
    notification.className = `custom-notification ${type}`;
    notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-icon">
                    ${
                      type === "success"
                        ? '<i class="fas fa-check-circle"></i>'
                        : '<i class="fas fa-exclamation-circle"></i>'
                    }
                </span>
                <span class="notification-message">${message}</span>
                <span class="notification-close"><i class="fas fa-times"></i></span>
            </div>
        `;

    document.body.appendChild(notification);

    notification
      .querySelector(".notification-close")
      .addEventListener("click", function () {
        notification.remove();
      });

    if (type === "success") {
      setTimeout(() => {
        notification.classList.add("notification-hide");
        setTimeout(() => notification.remove(), 500);
      }, 5000);
    }
  }

  const loginForms = document.querySelectorAll('form[action="login.php"]');

  loginForms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch("login.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            if ($("#loginpop").length) {
              $("#loginpop").modal("hide");
            }

            showNotification("Login successful! Redirecting...", "success");
            setTimeout(() => {
              window.location.href = "index.php";
            }, 1000);
          } else {
            showNotification(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showNotification("An error occurred. Please try again.");
        });
    });
  });

  const registerForm = document.getElementById("register-form");
  if (registerForm) {
    // Check if event listener already exists
    if (!registerForm.hasAttribute("data-event-attached")) {
      registerForm.addEventListener("submit", register);
      // Mark the form with an attribute to indicate event is attached
      registerForm.setAttribute("data-event-attached", "true");
    }

    function register(e) {
      e.preventDefault();

      // Prevent duplicate submissions
      if (isSubmitting) {
        return;
      }

      // Set submission flag
      isSubmitting = true;

      // Disable submit button
      const submitButton = this.querySelector('button[type="submit"]');
      if (submitButton) {
        submitButton.disabled = true;
        submitButton.innerHTML =
          '<i class="fas fa-spinner fa-spin"></i> Processing...';
      }

      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirm_password").value;

      if (password !== confirmPassword) {
        showNotification("Passwords do not match!");
        resetSubmitState();
        return;
      }

      const formData = new FormData(this);

      console.log("call api...");

      fetch("register.php", {
        method: "POST",
        body: formData,
        headers: {
          "X-Requested-With": "XMLHttpRequest",
        },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            if ($("#registerModal").length) {
              $("#registerModal").modal("hide");
            }
            if ($("#loginpop").length) {
              $("#loginpop").modal("hide");
            }
            showNotification(
              "Registration successful! Redirecting...",
              "success"
            );
            setTimeout(() => {
              window.location.href = "index.php";
            }, 1200);
          } else {
            showNotification(data.message);
            resetSubmitState();
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showNotification("An error occurred. Please try again.");
          resetSubmitState();
        });

      // Function to reset submit button and submission state
      function resetSubmitState() {
        isSubmitting = false;
        if (submitButton) {
          submitButton.disabled = false;
          submitButton.innerHTML = '<i class="fas fa-user-plus"></i> Register';
        }
      }
    }
  }
});
