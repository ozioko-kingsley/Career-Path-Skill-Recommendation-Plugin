<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add menu item for the plugin settings
function cpsr_add_admin_menu() {
    add_menu_page(
        'Career Path Settings', // Page title
        'Career Skills', // Menu title
        'manage_options', // Capability
        'cpsr_settings', // Menu slug
        'cpsr_settings_page', // Callback function
        'dashicons-welcome-learn-more', // Icon
        20 // Position
    );
}
add_action( 'admin_menu', 'cpsr_add_admin_menu' );

// Register and define settings
function cpsr_register_settings() {
    register_setting( 'cpsr_settings_group', 'cpsr_career_paths' );
}
add_action( 'admin_init', 'cpsr_register_settings' );

// Admin settings page content
function cpsr_settings_page() {
    ?>
    <div class="wrap">
        <h1>Career Path Skill Recommendation - Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'cpsr_settings_group' );
            do_settings_sections( 'cpsr_settings_group' );
            $career_paths = get_option( 'cpsr_career_paths', array(
                'web_developer' => 'Web Developer',
                'data_scientist' => 'Data Scientist',
                'graphic_designer' => 'Graphic Designer'
            ));
            ?>
            <h3>Manage Career Paths</h3>
            <table>
                <?php foreach ( $career_paths as $key => $label ) : ?>
                    <tr>
                        <td><input type="text" name="cpsr_career_paths[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $label ); ?>"></td>
                        <td><a href="#" class="remove-career-path">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <button type="button" id="add-career-path">Add Career Path</button>

            <?php submit_button(); ?>
        </form>
    </div>
    <script>
        document.getElementById('add-career-path').addEventListener('click', function () {
            let newRow = document.createElement('tr');
            newRow.innerHTML = '<td><input type="text" name="cpsr_career_paths[new]" value=""></td><td><a href="#" class="remove-career-path">Remove</a></td>';
            this.parentNode.querySelector('table').appendChild(newRow);
        });

        document.querySelectorAll('.remove-career-path').forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                this.closest('tr').remove();
            });
        });
    </script>
    <?php
}
?>
