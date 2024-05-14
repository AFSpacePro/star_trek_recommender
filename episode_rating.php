<?php
require_once 'config.php';  // Include the config file

// Create a new database connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Fetch episode details by ID
$episode_id = rand(0,904);
$query = "SELECT * FROM episode_list WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $episode_id);
$stmt->execute();
$result = $stmt->get_result();

if ($episode = $result->fetch_assoc()) {
    $series = $episode['Series'];
    $season = $episode['Season'];
    $number = $episode['Episode'];
    $title = $episode['Title'];
    $link = $episode['Link'];
} else {
    echo "<p>Episode not found.</p>";
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Episode Rater & Tagging</h2>
        <h3>Title: <?php echo $title; ?></h3>
        <p><?php echo $series . ' - Season ' . $season . ' Episode ' . $number; ?></p>
        <p><a href="<?php echo $link ?>">Click here for more details</a></p>
        <form action="rating_submit.php" method="post">
            <input type="hidden" name="episode_id" value="<?php echo $episode_id; ?>">
            <label for="rating"><h3>Rating (1-5)</h3></label>

            <!-- Additional form elements -->
            <div class="star-rating">
                <input type="radio" id="5-stars" name="rating" value="5" /><label for="5-stars" class="star">&#9733;</label>
                <input type="radio" id="4-stars" name="rating" value="4" /><label for="4-stars" class="star">&#9733;</label>
                <input type="radio" id="3-stars" name="rating" value="3" /><label for="3-stars" class="star">&#9733;</label>
                <input type="radio" id="2-stars" name="rating" value="2" /><label for="2-stars" class="star">&#9733;</label>
                <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" class="star">&#9733;</label>
            </div>

            <div class="tag-categories">
                <div class="tag-category">
                    <h3>Theme Tags</h3>
                    <div class="tags">
                        <!-- List of tags -->
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <button type="button" class="tag-more" onclick="expandTags('theme')">More...</button>
                    </div>
                    <!-- Input for suggesting new tags -->
                    <div class="tag-suggestion">
                        <input type="text" name="theme_suggestion" placeholder="Suggest new tags" />
                    </div>
                </div>
                <div class="tag-category">
                    <h3>Major Location Tags</h3>
                    <div class="tags">
                        <!-- List of tags -->
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <button type="button" class="tag-more" onclick="expandTags('locations')">More...</button>
                    </div> 
                    <!-- Input for suggesting new tags -->
                    <div class="tag-suggestion">
                        <input type="text" name="location_suggestion" placeholder="Suggest new tags" />
                    </div>                    
                </div>
                <div class="tag-category">
                    <h3>Tone Tags</h3>
                    <div class="tags">
                        <!-- List of tags -->
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <button type="button" class="tag-more" onclick="expandTags('tone')">More...</button>
                    </div> 
                    <!-- Input for suggesting new tags -->
                    <div class="tag-suggestion">
                        <input type="text" name="tone_suggestion" placeholder="Suggest new tags" />
                    </div>                    
                </div>
                <div class="tag-category">
                    <h3>Plot Focus Tags</h3>
                    <div class="tags">
                        <!-- List of tags -->
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <button type="button" class="tag-more" onclick="expandTags('plot')">More...</button>
                    </div>
                    <!-- Input for suggesting new tags -->
                    <div class="tag-suggestion">
                        <input type="text" name="plot_suggestion" placeholder="Suggest new tags" />
                    </div>                    
                </div>
                <div class="tag-category">
                    <h3>Species Focus Tags</h3>
                    <div class="tags">
                        <!-- List of tags -->
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <button type="button" class="tag-more" onclick="expandTags('species')">More...</button>
                    </div> 
                    <!-- Input for suggesting new tags -->
                    <div class="tag-suggestion">
                        <input type="text" name="species_suggestion" placeholder="Suggest new tags" />
                    </div>                    
                </div>
                <div class="tag-category">
                    <h3>Character Focus Tags</h3>
                    <div class="tags">
                        <!-- List of tags -->
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <span class="tag" onclick="toggleTag(this)">Adventure</span>
                        <span class="tag" onclick="toggleTag(this)">Diplomacy</span>
                        <button type="button" class="tag-more" onclick="expandTags('character')">More...</button>
                    </div> 
                    <!-- Input for suggesting new tags -->
                    <div class="tag-suggestion">
                        <input type="text" name="character_suggestion" placeholder="Suggest new tags" />
                    </div>                    
                </div> 
            </div>            
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function toggleTag(element) {
            element.classList.toggle('selected');
        }
    </script>
</body>