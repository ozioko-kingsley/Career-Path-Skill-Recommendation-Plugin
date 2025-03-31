<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Function to display career path selection and skills
function cpsr_display_skills_frontend() {
    $career_paths = get_option( 'cpsr_career_paths', array(
        'web_developer' => 'Web Developer',
        'data_scientist' => 'Data Scientist',
        'graphic_designer' => 'Graphic Designer'
    ));

    ob_start();
    ?>
    <div class="cpsr-container">
        <h2>Select a Career Path</h2>
        <form method="post">
            <select name="cpsr_career" id="cpsr-career">
                <?php foreach ($career_paths as $key => $label) : ?>
                    <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Get Skills">
        </form>

        <?php
        if ( isset( $_POST['cpsr_career'] ) ) {
            $selected_career = sanitize_text_field( $_POST['cpsr_career'] );
            cpsr_show_skills( $selected_career );
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'career_skills_display', 'cpsr_display_skills_frontend' );

// Function to show skill recommendations
function cpsr_show_skills( $career ) {
    $skills = array(
        'web_developer' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL'],
        'data_scientist' => ['Python', 'R', 'Machine Learning', 'Statistics', 'SQL'],
        'graphic_designer' => ['Photoshop', 'Illustrator', 'UI/UX', 'Sketch', 'Figma'],
    );

    if ( array_key_exists( $career, $skills ) ) {
        echo '<h3>Recommended Skills:</h3>';
        echo '<ul>';
        foreach ( $skills[$career] as $skill ) {
            echo '<li>' . esc_html( $skill ) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No skills found for this career path.</p>';
    }
}
?>
