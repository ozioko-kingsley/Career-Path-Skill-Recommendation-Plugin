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
        'graphic_designer' => 'Graphic Designer',
        'cybersecurity_analyst' => 'Cybersecurity Analyst',
        'digital_marketer' => 'Digital Marketer',
        'mobile_app_developer' => 'Mobile App Developer',
        'cloud_engineer' => 'Cloud Engineer',
        'ai_engineer' => 'AI Engineer'
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
        'web_developer' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL', 'React', 'Node.js', 'TypeScript', 'Git', 'API Development'],
        'data_scientist' => ['Python', 'R', 'Machine Learning', 'Statistics', 'SQL', 'Deep Learning', 'Big Data', 'Data Visualization', 'Pandas', 'TensorFlow'],
        'graphic_designer' => ['Photoshop', 'Illustrator', 'UI/UX', 'Sketch', 'Figma', 'Adobe XD', 'InDesign', 'Typography', 'Branding', 'Motion Graphics'],
        'cybersecurity_analyst' => ['Network Security', 'Ethical Hacking', 'Penetration Testing', 'Cryptography', 'Incident Response', 'SOC Analysis', 'Firewalls', 'SIEM', 'Malware Analysis', 'Threat Intelligence'],
        'digital_marketer' => ['SEO', 'Google Ads', 'Facebook Ads', 'Content Marketing', 'Email Marketing', 'Affiliate Marketing', 'Social Media Marketing', 'Google Analytics', 'Copywriting', 'Brand Strategy'],
        'mobile_app_developer' => ['Flutter', 'Kotlin', 'Swift', 'Dart', 'Java', 'React Native', 'Firebase', 'UI/UX for Mobile', 'MVVM', 'API Integration'],
        'cloud_engineer' => ['AWS', 'Azure', 'Google Cloud', 'Docker', 'Kubernetes', 'Terraform', 'DevOps', 'CI/CD', 'Networking', 'Linux'],
        'ai_engineer' => ['Machine Learning', 'Neural Networks', 'Deep Learning', 'Python', 'NLP', 'TensorFlow', 'PyTorch', 'Computer Vision', 'Reinforcement Learning', 'Data Engineering']
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
