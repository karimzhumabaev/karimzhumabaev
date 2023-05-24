<?php

class ContactForm {
    private $name;
    private $email;
    private $message;

    public function __construct($name, $email, $message) {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function validate() {
        // Perform validation on form fields
        if (empty($this->name) || empty($this->email) || empty($this->message)) {
            return false;
        }

        // Additional validation rules can be added here

        return true;
    }

    public function sendEmail() {
        // Send email notification to the website owner
        $to = "your-email@example.com";
        $subject = "New Contact Form Submission";
        $body = "Name: " . $this->name . "\n"
            . "Email: " . $this->email . "\n"
            . "Message: " . $this->message;

        // Use the mail() function to send the email
        if (mail($to, $subject, $body)) {
            echo "Thank you for your message. We will get back to you soon!";
        } else {
            echo "Oops! An error occurred while sending your message.";
        }
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $contactForm = new ContactForm($name, $email, $message);

    if ($contactForm->validate()) {
        $contactForm->sendEmail();
    } else {
        echo "Please fill in all the required fields.";
    }
}

?>

<!-- HTML form -->
<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>
    <h1>Contact Us</h1>
    <form method="POST" action="ContactForm.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
