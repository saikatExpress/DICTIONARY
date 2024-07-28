<?php 
    include_once '../auth/session.php'; 
    Session::checkSession();
?>
<?php include_once '../views/layout/header.php'; ?>

    <div class="main-content">
        <div class="page_title">
            <h2>Store a New Word</h2>
            <a href="wordlist.php">Word List</a>
        </div>
        <div id="showMsg">
            
        </div>
        <form id="word-form">
            <label for="word">Word:</label>
            <input type="text" id="word" name="word" required>
            
            <label for="meaning">Meaning:</label>
            <textarea id="meaning" name="meaning" required></textarea>
            
            <button type="submit">Submit</button>
        </form>
    </div>
<?php include_once '../views/layout/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('#word-form').submit(function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();
            
            $.ajax({
                url: '../auth/store_word.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if ($('#response-message').length === 0) {
                        $('#showMsg').append('<div id="response-message"></div>');
                    }
                    
                    // Set the response message
                    $('#response-message').html(response);
                    
                    // Show the response message
                    $('#response-message').fadeIn(400); // Adjust the duration as needed
                    
                    // Hide the response message after 3 seconds
                    setTimeout(function() {
                        $('#response-message').fadeOut(400); // Adjust the duration as needed
                    }, 3000);
                    
                    // Reset the form
                    $('#word-form')[0].reset();
                },
                error: function() {
                    $('#response-message').html('An error occurred while processing your request.');
                }
            });
        });
    });
</script>