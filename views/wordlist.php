<?php 
    include_once '../auth/session.php'; 
    Session::checkSession();
?>
<?php include_once '../views/layout/header.php'; ?>

    <div class="main-content">
        <div class="page_title">
            <h2>Store a New Word</h2>
            <a href="dictionary.php">Add Word</a>
        </div>

        <div class="filter">
            <select id="letter-filter">
                <option value="">All</option>
                <?php foreach (range('A', 'Z') as $letter): ?>
                    <option value="<?= $letter ?>"><?= $letter ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div id="wordTable" class="wordTable">
            <table>
                <thead>
                    <tr>
                        <th>Word</th>
                        <th>Meaning</th>
                    </tr>
                </thead>
                <tbody id="word-list">
                    <!-- Word list will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>
<?php include_once '../views/layout/footer.php'; ?>

<script>
    $(document).ready(function() {
        function fetchWords(filter = '') {
            $.ajax({
                url: '../auth/fetch_words.php',
                type: 'GET',
                data: { filter: filter },
                dataType: 'json',
                success: function(data) {
                    var wordList = $('#word-list');
                    wordList.empty();
                    $.each(data, function(index, word) {
                        wordList.append('<tr><td>' + word.name + '</td><td>' + word.meaning + '</td></tr>');
                    });
                },
                error: function() {
                    alert('Failed to fetch words.');
                }
            });
        }

        // Fetch all words on page load
        fetchWords();

        // Fetch filtered words when the filter changes
        $('#letter-filter').on('change', function() {
            var filter = $(this).val();
            fetchWords(filter);
        });
    });
</script>

