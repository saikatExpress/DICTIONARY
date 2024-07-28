<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="public/icons/dictionary1.png" type="image/x-icon">
    <title>BnDictionary | Your Word Companion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="ticker">
                    <div class="ticker-wrap">
                        <div class="ticker-item">🔠 Word of the Day: Serendipity</div>
                        <div class="ticker-item">📚 Most Hard Word: Antidisestablishmentarianism</div>
                        <div class="ticker-item">🔄 Update: New feature added for pronunciation guides!</div>
                        <div class="ticker-item">🔄 Update: New feature added for pronunciation guides!</div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-3">Search Dictionary Word</h3>
                <div class="input-group mb-3">
                    <input type="text" id="search-input" class="form-control" placeholder="Search for a word...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="search-button">Search</button>
                    </div>
                </div>
                <div class="suggestions-container">
                    <ul id="suggestions-list" class="list-group" style="display: none;"></ul>
                </div>
                <div id="search-results" class="mt-3"></div>
            </div>
            <div class="col-md-6">
                <h3 class="mb-3">Login</h3>
                <button class="btn btn-secondary mb-3" id="toggleForm">Show Login Form</button>
                <div class="form-container" id="loginForm" style="display: none;">
                    <p id="successMsg">
                        <?php if (isset($_SESSION['success'])) {
                            echo $_SESSION['success'];
                        } ?>
                    </p>
                    <form action="auth/login.php" method="POST">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <?php if (isset($errors['email'])): ?>
                                <p class="text-danger"><?php echo $errors['email']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <div class="links mt-3">
                        <p>Don't have an account? <a href="views/auth/register.html">Sign up here</a></p>
                        <p><a href="views/auth/forgot.html">Forgot password?</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="additional-sections mt-5">
            <div>
                <h4>Example Sentences</h4>
                <div class="post">
                    <h5>Example Sentence 1</h5>
                    <p>This is an example sentence showing the use of a word.</p>
                </div>
                <div class="post">
                    <h5>Example Sentence 2</h5>
                    <p>This is another example sentence demonstrating word usage.</p>
                </div>
            </div>
            <div>
                <h4>Help Posts</h4>
                <div class="post">
                    <h5>Help Post 1</h5>
                    <p>Here's some helpful information related to the dictionary.</p>
                </div>
                <div class="post">
                    <h5>Help Post 2</h5>
                    <p>More tips and tricks for using the dictionary effectively.</p>
                </div>
            </div>
            <div>
                <h4>Questions</h4>
                <div class="question">
                    <h5>Question 1</h5>
                    <p>How do I find synonyms using this dictionary?</p>
                </div>
                <div class="question">
                    <h5>Question 2</h5>
                    <p>What is the best way to remember new words?</p>
                </div>
            </div>
            <div>
                <h4>Answered Questions</h4>
                <div class="answered-question">
                    <h5>Answered Question 1</h5>
                    <p>You can find synonyms by using the thesaurus feature of our dictionary.</p>
                </div>
                <div class="answered-question">
                    <h5>Answered Question 2</h5>
                    <p>Using flashcards and regular practice can help you remember new words.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="public/assets/js/style.js"></script>
    <script>
        document.getElementById('toggleForm').addEventListener('click', function() {
            var formContainer = document.getElementById('loginForm');
            if (formContainer.style.display === 'block') {
                formContainer.style.display = 'none';
                this.textContent = 'Show Login Form';
            } else {
                formContainer.style.display = 'block';
                this.textContent = 'Hide Login Form';
            }
        });

        setTimeout(function() {
            var successMsg = document.getElementById('successMsg');
            successMsg.style.opacity = 0;
            setTimeout(function() {
                successMsg.style.display = 'none';
            }, 600);
        }, 3000);

        $(document).ready(function() {
            $('#search-input').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'auth/autocomplete.php',
                        type: 'GET',
                        data: { term: query },
                        success: function(response) {
                            var suggestions = JSON.parse(response);
                            var suggestionsList = $('#suggestions-list');
                            suggestionsList.empty();
                            if (suggestions.length > 0) {
                                suggestionsList.show();
                                $.each(suggestions, function(index, suggestion) {
                                    suggestionsList.append('<li class="list-group-item suggestion-item">' + suggestion + '</li>');
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

            $(document).on('click', '.suggestion-item', function() {
                $('#search-input').val($(this).text());
                $('#suggestions-list').hide();
            });

            $(document).click(function(event) {
                if (!$(event.target).closest('#search-input').length && !$(event.target).closest('#suggestions-list').length) {
                    $('#suggestions-list').hide();
                }
            });

            $('#search-button').click(function() {
                var query = $('#search-input').val();
                $.ajax({
                    url: 'auth/search.php',
                    type: 'GET',
                    data: { word: query },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var resultsHtml = '';
                        if (data.success) {
                            $.each(data.meanings, function(category, meanings) {
                                resultsHtml += '<div class="category">';
                                resultsHtml += '<h4 class="category-title">' + category + '</h4>';
                                resultsHtml += '<ul class="list-group">';
                                $.each(meanings, function(index, meaning) {
                                    resultsHtml += '<li class="list-group-item meaning-item ' + category.toLowerCase() + '">' + meaning + '</li>';
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
