<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_ValTown_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'valtown_widget';
    }

    public function get_title() {
        return esc_html__('Val Town App', 'valtown-elementor');
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['valtown', 'app', 'embed'];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'valtown-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'val_url',
            [
                'label' => esc_html__('Val Town URL', 'valtown-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'https://val.town/v/username/valname',
                'description' => 'Enter the full URL to your Val Town web app',
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => esc_html__('Height', 'valtown-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .valtown-iframe' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section  
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'valtown-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .valtown-iframe',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'valtown-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .valtown-iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (empty($settings['val_url'])) {
            echo '<p>Please enter a Val Town URL</p>';
            return;
        }

        // Convert val.town URL to web app URL
        $url = str_replace('val.town/v/', 'val.town/embed/', $settings['val_url']);
        ?>
        <div class="valtown-container">
            <iframe 
                class="valtown-iframe"
                src="<?php echo esc_url($url); ?>"
                width="100%"
                frameborder="0"
                allowtransparency="true"
                style="display: block;"
            ></iframe>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <# if (!settings.val_url) { #>
            <p>Please enter a Val Town URL</p>
        <# } else { #>
            <div class="valtown-container">
                <iframe 
                    class="valtown-iframe"
                    src="{{ settings.val_url.replace('val.town/v/', 'val.town/embed/') }}"
                    width="100%"
                    frameborder="0"
                    allowtransparency="true"
                    style="display: block;"
                ></iframe>
            </div>
        <# } #>
        <?php
    }
}