<?php
/**
 * Plugin Name: Career Path Skill Recommendation
 * Description: A plugin to suggest relevant skills based on career paths.
 * Version: 1.0
 * Author: Kingsley Ozioko
 * Author URI: https://skilllink.infinityfreeapp.com/
 * GitHub: https://github.com/ozioko-kingsley/Career-Path-Skill-Recommendation-Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Register shortcode
function cpsr_display_skill_recommendations() {
    ob_start();
    ?>
    <div class="career-path-skill-recommendation">
        <h2>Select Your Career Path</h2>
        <form method="post">
            <select name="career_path" id="career-path">
                <option value="web_developer">Web Developer</option>
                <option value="data_scientist">Data Scientist</option>
                <option value="graphic_designer">Graphic Designer</option>
            </select>
            <input type="submit" value="Get Recommendations">
        </form>

        <?php
        if ( isset( $_POST['career_path'] ) ) {
            $career_path = sanitize_text_field( $_POST['career_path'] );
            cpsr_display_recommended_skills( $career_path );
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'career_path_skills', 'cpsr_display_skill_recommendations' );

// Function to display recommended skills
function cpsr_display_recommended_skills( $career_path ) {
    $skills = array(
        'web_developer' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL'],
        'data_scientist' => ['Python', 'R', 'Machine Learning', 'Statistics', 'SQL'],
        'graphic_designer' => ['Adobe Photoshop', 'Illustrator', 'UI/UX Design', 'Sketch', 'Figma'],
    );

    if ( array_key_exists( $career_path, $skills ) ) {
        echo '<h3>Recommended Skills:</h3>';
        echo '<ul>';
        foreach ( $skills[$career_path] as $skill ) {
            echo '<li>' . esc_html( $skill ) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No recommendations available for this career path.</p>';
    }
}

function cpsr_display_form() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'includes/frontend-display.php';
    return ob_get_clean();
}
add_shortcode('career_skills_display', 'cpsr_display_form');

?>
