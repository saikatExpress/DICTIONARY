<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="public/icons/dictionary1.png" type="image/x-icon">
    <title>BnDictionary | Login</title>

    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    
    <div class="dictionary-section">
        <h3>Dictionary Lookup</h3>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search for a word...">
            <div class="suggestions-container">
                <ul id="suggestions-list" style="display: none;"></ul>
            </div>
            <button type="button" id="search-button">Search</button>
        </div>

        <div id="search-results"></div>

        <div class="article">
            <h4>Benefits of Using a Dictionary</h4>
            <p>A dictionary is an invaluable tool for learning and improving your language skills. Here are some benefits:</p>
            <ul>
                <li><strong>Enhanced Vocabulary:</strong> Regular use of a dictionary helps you learn new words and their meanings, which can improve your communication skills.</li>
                <li><strong>Accurate Pronunciation:</strong> Dictionaries often provide phonetic spellings and pronunciation guides, helping you pronounce words correctly.</li>
                <li><strong>Grammar and Usage:</strong> Understanding the correct usage of words and their grammatical roles is crucial for effective writing and speaking.</li>
                <li><strong>Cultural Insight:</strong> Some dictionaries offer historical and cultural information about words, enhancing your understanding of language and context.</li>
            </ul>
        </div>
    </div>

    <div class="container">
        <h2>Login</h2>
        <button id="toggleForm">Show Login Form</button>
        <div class="form-container" id="loginForm">
            <p id="successMsg">
                <?php
                if (isset($_SESSION['success'])) {
                    echo $_SESSION['success'];
                }
                ?>
            </p>
            <form action="auth/login.php" method="POST">
                <input type="email" name="email" placeholder="Email">
                <?php if (isset($errors['email'])): ?>
                    <p class="error"><?php echo $errors['email']; ?></p>
                <?php endif; ?>
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
            <div class="links">
                <p>Don't have an account? <a href="views/auth/register.html">Sign up here</a></p>
                <p><a href="views/auth/forgot.html">Forgot password?</a></p>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="public/assets/js/style.js"></script>

    <script>
        document.getElementById('toggleForm').addEventListener('click', function() {
            var formContainer = document.getElementById('loginForm');
            if (formContainer.classList.contains('show')) {
                formContainer.classList.remove('show');
                this.textContent = 'Show Login Form';
            } else {
                formContainer.classList.add('show');
                this.textContent = 'Hide Login Form';
            }
        });

        setTimeout(function() {
            var successMsg = document.getElementById('successMsg');
            successMsg.style.opacity = 0;
            setTimeout(function() {
                successMsg.style.display = 'none';
            }, 600); // Delay to allow fade out transition
        }, 3000); // 3 seconds
    </script>

    <script>
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                var query = $(this).val();
                
                if (query.length > 0) {
                    // Perform the AJAX request to fetch suggestions
                    $.ajax({
                        url: 'auth/autocomplete.php', // URL to your PHP script
                        type: 'GET',
                        data: { term: query },
                        success: function(response) {
                            console.log(response);
                            
                            var suggestions = JSON.parse(response);
                            var suggestionsList = $('#suggestions-list');
                            suggestionsList.empty();
                            
                            if (suggestions.length > 0) {
                                suggestionsList.show();
                                $.each(suggestions, function(index, suggestion) {
                                    suggestionsList.append('<li class="suggestion-item">' + suggestion + '</li>');
                                });
                            } else {
                                suggestionsList.hide();
                            }
                        },
                        error: function() {
                            $('#suggestions-list').hide();
                        }
                    });
                } else {
                    $('#suggestions-list').hide();
                }
            });

            // Handle click on suggestion
            $(document).on('click', '.suggestion-item', function() {
                $('#search-input').val($(this).text());
                $('#suggestions-list').hide();
            });

            // Hide suggestions when clicking outside
            $(document).click(function(event) {
                if (!$(event.target).closest('#search-input').length && !$(event.target).closest('#suggestions-list').length) {
                    $('#suggestions-list').hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#search-button').click(function() {
                var query = $('#search-input').val();
                // Perform the AJAX request
                $.ajax({
                    url: 'auth/search.php', // URL to your PHP script
                    type: 'GET',
                    data: { word: query },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var resultsHtml = '';

                        if (data.success) {
                            $.each(data.meanings, function(category, meanings) {
                                resultsHtml += '<div class="category">';
                                resultsHtml += '<h3 class="category-title">' + category + '</h3>';
                                resultsHtml += '<ul class="meanings-list">';
                                $.each(meanings, function(index, meaning) {
                                    resultsHtml += '<li class="meaning-item">' + meaning + '</li>';
                                });
                                resultsHtml += '</ul></div>';
                            });
                        } else {
                            resultsHtml = 'No results found.';
                        }

                        $('#search-results').html(resultsHtml);
                    },
                    error: function() {
                        $('#search-results').html('An error occurred while processing your request.');
                    }
                });
            });
        });
    </script>
</body>
</html>
