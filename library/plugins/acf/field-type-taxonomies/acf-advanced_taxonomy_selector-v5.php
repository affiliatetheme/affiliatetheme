<?php
/**
 * ACF 5 Field Class
 *
 * This file holds the class required for our field to work with ACF 5
 *
 * @author Daniel Pataki
 * @since 3.0.0
 *
 */

/**
 * ACF 5 Taxonomy Selector Class
 *
 * The taxonomy selector class enables users to select terms and taxonomies.
 * This is the class that is used for ACF 5.
 *
 * @author Daniel Pataki
 * @since 3.0.0
 *
 */

class acf_field_advanced_taxonomy_selector extends acf_field {


    /**
     * Field Constructor
     *
     * Sets basic properties and runs the parent constructor
     *
     * @author Daniel Pataki
     * @since 3.0.0
     *
     */
    function __construct() {

        $this->name = 'advanced_taxonomy_selector';
        $this->label = __('Advanced Taxonomy Selector', 'acf-advanced_taxonomy_selector');
        $this->category = 'Relational';

        $this->defaults = array(
            'taxonomies' => '',
            'data_type' => 'terms',
            'field_type' => 'multiselect',
            'allow_null' => true,
            'post_type'  => false,
            'return_value' => 'term_id'
        );

        parent::__construct();

    }




    /**
     * Field Options
     *
     * Creates the options for the field, they are shown when the user
     * creates a field in the back-end. Currently there are six fields.
     *
     * The Type sets the field to a term or a taxonomy selector
     *
     * The Taxonomies setting will put a restriction on the taxonomies shown
     *
     * The Restrict To Post Type setting allows you to restrict to taxonomies
     * defined for the selected post types
     *
     * The Field Type setting sets the type of field shown to the user
     *
     * By checking Allow Null you can make sure that users can select an empty
     * value
     *
     * The Return Value determines how the value is returned to be used on the
     * front end
     *
     * @param array $field The details of this field
     * @author Daniel Pataki
     * @since 3.0.0
     *
     */
    function render_field_settings( $field ) {

        acf_render_field_setting( $field, array(
            'label'			=> __('Type','acf-advanced-taxonomy-selector'),
            'type'			=> 'radio',
            'name'			=> 'data_type',
            'choices' =>  array(
                'terms' => __( 'Term Selector', 'acf-advanced-taxonomy-selector' ),
                'taxonomy'  => __( 'Taxonomy Selector', 'acf-advanced-taxonomy-selector' ),
            )
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Taxonomy Restrictions','acf-advanced-taxonomy-selector'),
            'type'			=> 'select',
            'name'			=> 'taxonomies',
            'multiple'      =>  true,
            'choices'       =>  acfats_taxonomies_array()
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Post Type Restrictions','acf-advanced-taxonomy-selector'),
            'type'			=> 'select',
            'name'			=> 'post_type',
            'multiple'      =>  true,
            'choices'       =>  acfats_post_types_array()
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Field Type','acf-advanced-taxonomy-selector'),
            'type'			=> 'select',
            'name'			=> 'field_type',
            'choices' =>  array(
                'multiselect'  => __( 'Multiselect', 'acf-advanced-taxonomy-selector' ),
                'select'       => __( 'Select', 'acf-advanced-taxonomy-selector' )
            )
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Allow Null?','acf-advanced-taxonomy-selector'),
            'type'			=> 'radio',
            'name'			=> 'allow_null',
            'layout'  => 'horizontal',
            'choices' =>  array(
                1 => __( 'Yes', 'acf-advanced-taxonomy-selector' ),
                0  => __( 'No', 'acf-advanced-taxonomy-selector' ),
            )
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Return Value','acf-advanced-taxonomy-selector'),
            'type'			=> 'radio',
            'name'			=> 'return_value',
            'choices' =>  array(
                'term_id' => __( 'Term ID / Taxonomy Slug', 'acf-advanced-taxonomy-selector' ),
                'object'  => __( 'Term Object / Taxonomy Object', 'acf-advanced-taxonomy-selector' ),
            )
        ));


    }



    /**
     * Field Display
     *
     * This function takes care of displaying our field to the users, taking
     * the field options into account.
     *
     * @param array $field The details of this field
     * @author Daniel Pataki
     * @since 3.0.0
     *
     */
    function render_field( $field ) {
        call_user_func( array( $this, 'render_field_' . $field['data_type'] ), $field );
    }


    /**
     * Term Type Field Display
     *
     * Displays the field when the Type setting is set to term
     *
     * @param array $field The details of this field
     * @author Daniel Pataki
     * @since 3.0.0
     *
     */
    function render_field_terms( $field ) {
        $taxonomies = acfats_get_taxonomies_from_selection( $field );
        $multiple = ( $field['field_type'] == 'multiselect' ) ? 'multiple="multiple"' : '';

        foreach( $taxonomies as $slug => $taxonomy ) {
            if( wp_count_terms( $slug ) == 0 ) {
                unset( $taxonomies[$slug] );
            }
        }
        ?>
        <select name="<?php echo $field['name'] ?>[]" <?php echo $multiple ?>>
            <?php if( $field['allow_null'] == true ) : ?>
                <option value=''><?php _e( 'None', 'acf-advanced_taxonomy_selector' ) ?></option>
            <?php endif ?>
            <?php
            foreach( $taxonomies as $taxonomy ) :
                ?>
                <optgroup label='<?php echo $taxonomy->label ?>'>
                    <?php
                    $selected = 0;

                    if(isset($field['value'])) {
                        $selected = str_replace($taxonomy->name . '_', '', $field['value'][0]);
                    }

                    $terms_args = array(
                        'taxonomy'      => $taxonomy->name,
                        'orderby'       => 'name',
                        'show_count'    => 1,
                        'hierarchical'  => 1,
                        'selected'      => $selected,
                    );
                    $terms_list = at_get_hierarchical_dropdown($terms_args, true);
                    echo $terms_list;
                    ?>
                </optgroup>
            <?php endforeach ?>
        </select>

        <?php
    }

    /**
     * Taxonomy Type Field Display
     *
     * Displays the field when the Type setting is set to taxonomy
     *
     * @param array $field The details of this field
     * @author Daniel Pataki
     * @since 3.0.0
     *
     */
    function render_field_taxonomy( $field ) {
        $taxonomies = acfats_get_taxonomies_from_selection( $field );
        $multiple = ( $field['field_type'] == 'multiselect' ) ? 'multiple="multiple"' : '';
        ?>

        <select name="<?php echo $field['name'] ?>[]" <?php echo $multiple ?>>
            <?php if( $field['allow_null'] == true ) : ?>
                <option value=''><?php _e( 'None', 'acf-advanced_taxonomy_selector' ) ?></option>
            <?php endif ?>
            <?php if( empty( $taxonomies ) ) : ?>
                <option><?php _e( 'No Taxonomies Exist For This Post Type', 'acf-advanced_taxonomy_selector' ) ?></option>

            <?php else :
                foreach( $taxonomies as $taxonomy ) :
                    $selected = ( !empty( $field['value'] ) && in_array( $taxonomy->name, $field['value'] ) ) ? 'selected="selected"' : '';
                    ?>
                    <option <?php echo $selected ?> value='<?php echo $taxonomy->name ?>'><?php echo $taxonomy->label ?></option>
                <?php endforeach ?>
            <?php endif ?>
        </select>

        <?php
    }


    /**
     * Pre-Save Value Modification
     *
     * Modifies the data before it is passed to the database for saving
     *
     * @param mixed $value The value which was loaded from the database
     * @param int $post_id The $post_id from which the value was loaded
     * @param array $field The details of this field
     * @return mixed $value The modified value
     * @author Daniel Pataki
     * @since 3.0.0
     *
     */
    function update_value( $value, $post_id, $field ) {

        if( $value == array( 0 => '' ) ) {
            return '';
        }

        return $value;

    }


    /**
     * Format Value
     *
     * This filter is appied to the $value after it is loaded from the
     * db and before it is passed to the create_field action
     *
     * @param mixed $value The value which was loaded from the database
     * @param int $post_id The $post_id from which the value was loaded
     * @param array $field The details of this field
     * @return mixed $value The modified value
     * @author Daniel Pataki
     * @since 3.0.0
     *
     */
    function format_value( $value, $post_id, $field ) {

        if( empty($value) ) {
            return $value;
        }

        if( $field['data_type'] == 'terms' ) {
            foreach( $value as $i => $val ) {
                $term = substr( $val, strrpos( $val, '_' ) + 1 );
                if( $field['return_value'] == 'object' ) {
                    $taxonomy = substr( $val, 0, strrpos( $val, '_' ) );
                    $term = get_term( $term, $taxonomy );
                }
                $value[$i] = $term;
            }
        }
        elseif( $field['data_type'] == 'taxonomy' && $field['return_value'] == 'object' ) {
            foreach( $value as $i => $val ) {
                $value[$i] = get_taxonomy( $val );
            }
        }

        return $value;
    }


}


// create field
new acf_field_advanced_taxonomy_selector();

?>
