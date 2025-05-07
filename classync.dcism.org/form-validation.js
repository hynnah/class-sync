// Form validation for Classync login and registration pages

// Function to validate login form
function validateLogin(event) {
    event.preventDefault();
    
    let email = document.querySelector('input[name="email"]').value.trim();
    let password = document.querySelector('input[name="password"]').value;
    
    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");
    
    // Clear previous error messages
    if (emailError) emailError.textContent = "";
    if (passwordError) passwordError.textContent = "";
    
    let hasError = false;
    
    // Check for empty fields
    if (!email || !password) {
        alert("Oops! All fields are required!");
        return false;
    }
    
    // Validate email format
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        if (!emailError) {
            emailError = document.createElement("span");
            emailError.id = "emailError";
            emailError.className = "error-message";
            document.querySelector('input[name="email"]').insertAdjacentElement('afterend', emailError);
        }
        emailError.textContent = "Invalid email format";
        hasError = true;
    }
    
    // Simple password validation (can be expanded)
    if (password.length < 6) {
        if (!passwordError) {
            passwordError = document.createElement("span");
            passwordError.id = "passwordError";
            passwordError.className = "error-message";
            document.querySelector('input[name="password"]').insertAdjacentElement('afterend', passwordError);
        }
        passwordError.textContent = "Password must be at least 6 characters";
        hasError = true;
    }
    
    if (hasError) {
        return false;
    }
    
    // If validation passes, submit the form
    document.querySelector("form").submit();
    return true;
}

// Function to validate registration form
function validateRegistration(event) {
    event.preventDefault();
    
    let name = document.querySelector('input[name="name"]').value.trim();
    let email = document.querySelector('input[name="email"]').value.trim();
    let password = document.querySelector('input[name="password"]').value;
    let confirmPassword = document.querySelector('input[name="confirm_password"]').value;
    let accountType = document.querySelector('select[name="account-type"]').value;
    
    let nameError = document.getElementById("nameError");
    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");
    let confirmPasswordError = document.getElementById("confirmPasswordError");
    let accountTypeError = document.getElementById("accountTypeError");
    
    // Clear previous error messages
    if (nameError) nameError.textContent = "";
    if (emailError) emailError.textContent = "";
    if (passwordError) passwordError.textContent = "";
    if (confirmPasswordError) confirmPasswordError.textContent = "";
    if (accountTypeError) accountTypeError.textContent = "";
    
    let hasError = false;
    
    // Check for empty fields
    if (!name || !email || !password || !confirmPassword) {
        alert("Oops! All fields are required!");
        return false;
    }
    
    // Validate name (at least 2 characters)
    if (name.length < 2) {
        if (!nameError) {
            nameError = document.createElement("span");
            nameError.id = "nameError";
            nameError.className = "error-message";
            document.querySelector('input[name="name"]').insertAdjacentElement('afterend', nameError);
        }
        nameError.textContent = "Name must be at least 2 characters";
        hasError = true;
    }
    
    // Validate email format
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        if (!emailError) {
            emailError = document.createElement("span");
            emailError.id = "emailError";
            emailError.className = "error-message";
            document.querySelector('input[name="email"]').insertAdjacentElement('afterend', emailError);
        }
        emailError.textContent = "Invalid email format";
        hasError = true;
    }
    
    // Validate password (at least 8 characters)
    if (password.length < 8) {
        if (!passwordError) {
            passwordError = document.createElement("span");
            passwordError.id = "passwordError";
            passwordError.className = "error-message";
            document.querySelector('input[name="password"]').insertAdjacentElement('afterend', passwordError);
        }
        passwordError.textContent = "Password must be at least 8 characters";
        hasError = true;
    }
    
    // Check if passwords match
    if (password !== confirmPassword) {
        if (!confirmPasswordError) {
            confirmPasswordError = document.createElement("span");
            confirmPasswordError.id = "confirmPasswordError";
            confirmPasswordError.className = "error-message";
            document.querySelector('input[name="confirm_password"]').insertAdjacentElement('afterend', confirmPasswordError);
        }
        confirmPasswordError.textContent = "Passwords DO NOT match!";
        hasError = true;
    }
    
    // Validate account type is selected
    if (!accountType) {
        if (!accountTypeError) {
            accountTypeError = document.createElement("span");
            accountTypeError.id = "accountTypeError";
            accountTypeError.className = "error-message";
            document.querySelector('select[name="account-type"]').insertAdjacentElement('afterend', accountTypeError);
        }
        accountTypeError.textContent = "Please select an account type";
        hasError = true;
    }
    
    if (hasError) {
        return false;
    }
    
    // If validation passes, show success message and submit the form
    alert("Registration Successful, YAY!");
    document.querySelector("form").submit();
    return true;
}

// Initialize form validation when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to forms
    let loginForm = document.querySelector('form[action="verification.php"]');
    
    if (loginForm) {
        // Check if this is the login page or registration page based on form elements
        if (document.querySelector('input[name="confirm_password"]')) {
            // This is the registration page
            loginForm.addEventListener('submit', validateRegistration);
        } else {
            // This is the login page
            loginForm.addEventListener('submit', validateLogin);
        }
    }
    
    // Add CSS for error messages
    let style = document.createElement('style');
    style.innerHTML = `
        .error-message {
            color: red;
            font-size: 12px;
            display: block;
            margin-top: 5px;
            font-family: 'DM Sans', sans-serif;
        }
        
        input.error, select.error {
            border: 1px solid red;
        }
    `;
    document.head.appendChild(style);
});

// Function to clear form fields
function clearForm() {
    document.querySelector("form").reset();
    
    // Clear all error messages
    let errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach(function(errorMessage) {
        errorMessage.textContent = "";
    });
    
    // Remove error class from inputs
    let errorInputs = document.querySelectorAll(".error");
    errorInputs.forEach(function(input) {
        input.classList.remove("error");
    });
}