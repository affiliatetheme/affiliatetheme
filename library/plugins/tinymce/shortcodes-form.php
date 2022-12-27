<?php
/**
 * Affiliate Theme Shortcode Generator Formular
 *
 * @author		Christian Lang
 * @version		1.0
 * @category	tinymce
 */

add_action('wp_ajax_at_shortcodes_form', 'at_shortcodes_form');
function at_shortcodes_form() {
    ?>
    <div id="endcore-shortcodes-form">
        <div class="endcore-shortcodes-form">
            <div class="endcore-shortcodes-form-top">
                <div class="endcore-shortcodes-form-types">
                    <ul>
                        <li class="endcore-shortcodes-form-type-grid active" type="grid"><a href="#"><?php _e('Grid', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-button" type="button"><a href="#"><?php _e('Buttons', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-alert" type="alert"><a href="#"><?php _e('Alerts', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-media" type="media"><a href="#"><?php _e('Media', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-tabs" type="tabs"><a href="#"><?php _e('Tabs', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-accordion" type="accordion"><a href="#"><?php _e('Accordion', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-blogposts" type="blogposts"><a href="#"><?php _e('Blog-Beiträge', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-products" type="products"><a href="#"><?php _e('Produkte', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-infobox" type="infobox"><a href="#"><?php _e('Infobox', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-price_compare" type="price_compare"><a href="#"><?php _e('Preisvergleich', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-responsive" type="responsive"><a href="#"><?php _e('Responsive Content', 'affiliatetheme-backend'); ?></a></li>
                        <li class="endcore-shortcodes-form-type-taxonomyimages" type="taxonomyimages"><a href="#"><?php _e('Taxonomie-Bilder', 'affiliatetheme-backend'); ?></a></li>
                    </ul>
                </div>
                <!-- end types -->
                <div class="endcore-shortcodes-form-tabs">
                    <!-- COLUMNS -->
                    <div class="endcore-shortcodes-form-tab active" id="endcore-shortcodes-form-tab_grid"
                         style="display:block">
                        <h2>Grid</h2>
                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="2">
                                        <div class="column-structures">
                                            <label><?php _e('Wähle das gewünschte Layout aus', 'affiliatetheme-backend'); ?></label>
                                            <a href="#" class="active" split="50|50"><span
                                                    style="width:50%"><i>&frac12;</i></span><span
                                                    style="width:50%"><i>&frac12;</i></span></a>

                                            <div class="clearfix"></div>
                                            <a href="#" split="33|33|33"><span
                                                    style="width:33%"><i>&frac13;</i></span><span
                                                    style="width:33%"><i>&frac13;</i></span><span
                                                    style="width:33%"><i>&frac13;</i></span></a>
                                            <a href="#" split="67|33"><span
                                                    style="width:67%"><i>&frac23;</i></span><span
                                                    style="width:33%"><i>&frac13;</i></span></a>
                                            <a href="#" split="33|67"><span
                                                    style="width:33%"><i>&frac13;</i></span><span
                                                    style="width:67%"><i>&frac23;</i></span></a>

                                            <div class="clearfix"></div>
                                            <a href="#" split="25|25|25|25"><span
                                                    style="width:25%"><i>&frac14;</i></span><span
                                                    style="width:25%"><i>&frac14;</i></span><span
                                                    style="width:25%"><i>&frac14;</i></span><span
                                                    style="width:25%"><i>&frac14;</i></span></a>
                                            <a href="#" split="50|25|25"><span
                                                    style="width:50%"><i>&frac12;</i></span><span
                                                    style="width:25%"><i>&frac14;</i></span><span
                                                    style="width:25%"><i>&frac14;</i></span></a>
                                            <a href="#" split="25|25|50"><span
                                                    style="width:25%"><i>&frac14;</i></span><span
                                                    style="width:25%"><i>&frac14;</i></span><span
                                                    style="width:50%"><i>&frac12;</i></span></a>
                                            <a href="#" split="25|50|25"><span
                                                    style="width:25%"><i>&frac14;</i></span><span
                                                    style="width:50%"><i>&frac12;</i></span><span
                                                    style="width:25%"><i>&frac14;</i></span></a>
                                            <input style="display:none" type="text" fieldname="structure"
                                                   value="50|50"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Spalte 1', 'affiliatetheme-backend'); ?></label></th>
                                    <td><textarea fieldname="col"></textarea></td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Spalte 2', 'affiliatetheme-backend'); ?></label></th>
                                    <td><textarea fieldname="col"></textarea></td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Spalte 3', 'affiliatetheme-backend'); ?></label></th>
                                    <td><textarea fieldname="col" disabled="disabled"></textarea></td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Spalte 4', 'affiliatetheme-backend'); ?></label></th>
                                    <td><textarea fieldname="col" disabled="disabled"></textarea></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                    <!-- BUTTON -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_button">
                        <h2><?php _e('Buttons', 'affiliatetheme-backend'); ?></h2>
                        <p><?php _e('Einige Beispiele findest du hier: http://demo01.affiliatetheme.io/content/typografie/', 'affiliatetheme-backend'); ?></p>
                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Text', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="text" fieldname="button_text" />
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Link', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="text" fieldname="button_href" />
                                        <span class="tip"><?php _e('Externe URLs müssen http:// oder https:// enthalten!', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Farbe', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="button_color">
                                            <option value="btn-primary" selected="selected"><?php _e('Custom Farbe (Customizer, btn-primary)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-grayl"><?php _e('Hellgrau (btn-grayl)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-gray"><?php _e('Grau (btn-gray)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-grayd"><?php _e('Dunkelgrau (btn-grayd)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-black"><?php _e('Schwarz (btn-black)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-default"><?php _e('Weiß (btn-default)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-success"><?php _e('Grün (btn-success)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-info"><?php _e('Blau (btn-info)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-warning"><?php _e('Orange (btn-warning)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-danger"><?php _e('Rot (btn-danger)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-link"><?php _e('Transparent (btn-link)', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Größe', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="button_size">
                                            <option value="btn-xs"><?php _e('Extra Klein', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-sm"><?php _e('Klein', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-md" selected="selected"><?php _e('Normal', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-lg"><?php _e('Groß', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Form', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="button_shape">
                                            <option value="btn-square"><?php _e('Eckig (btn-square)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-rounded" selected="selected"><?php _e('Leicht Rund (btn-rounded)', 'affiliatetheme-backend'); ?></option>
                                            <option value="btn-round"><?php _e('Rund (btn-round)', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Kontur (Outline)', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="button_outline">
                                            <option value="false" selected="selected"><?php _e('Nein', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Ja', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Volle Breite (Block)', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="button_block">
                                            <option value="false" selected="selected"><?php _e('Nein', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Ja', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Icon', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="text" fieldname="button_icon" placeholder="fa-download"/>
                                        <span class="tip"><?php _e('Du findest alle Möglichen Icons hier: http://fortawesome.github.io/Font-Awesome/icons/', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Position des Icons', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="button_icon_pos">
                                            <option value="" selected="selected"></option>
                                            <option value="left"><?php _e('Links', 'affiliatetheme-backend'); ?></option>
                                            <option value="right"><?php _e('Rechts', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Link im neuen Tab öffnen?', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="button_target">
                                            <option value="" selected="selected"><?php _e('Nein', 'affiliatetheme-backend'); ?></option>
                                            <option value="_blank"><?php _e('Ja', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Nofollow?', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="button_rel">
                                            <option value="" selected="selected"><?php _e('Nein', 'affiliatetheme-backend'); ?></option>
                                            <option value="nofollow"><?php _e('Ja', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Weitere CSS-Klasse(n)', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="text" fieldname="button_class" />
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div><!-- end tab -->
                    <!-- ALERT -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_alert">
                        <h2><?php _e('Alerts', 'affiliatetheme-backend'); ?></h2>
                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Style', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="alert_style">
                                            <option value="success" selected="selected"><?php _e('Grün', 'affiliatetheme-backend'); ?></option>
                                            <option value="info"><?php _e('Blau', 'affiliatetheme-backend'); ?></option>
                                            <option value="warning"><?php _e('Gelb', 'affiliatetheme-backend'); ?></option>
                                            <option value="danger"><?php _e('Rot', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip"><?php _e('Ein Beispiel findest du hier: http://getbootstrap.com/components/#alerts', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Inhalt', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <textarea fieldname="alert_content"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                    <!-- MEDIA -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_media">
                        <h2><?php _e('Media', 'affiliatetheme-backend'); ?></h2>

                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Style', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="media_style">
                                            <option value="left" selected="selected"><?php _e('Objekt Links', 'affiliatetheme-backend'); ?></option>
                                            <option value="right"><?php _e('Objekt rechts', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip"><?php _e('Ein Beispiel findest du hier: http://getbootstrap.com/components/#media', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Horizontale Ausrichtung', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="media_aligned">
                                            <option value="top" selected="selected"><?php _e('Oben', 'affiliatetheme-backend'); ?></option>
                                            <option value="middle"><?php _e('Mittig', 'affiliatetheme-backend'); ?></option>
                                            <option value="bottom"><?php _e('Unten', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip"><?php _e('Horizontale Ausrichtung des Bildes', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Objekt', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="text" fieldname="media_object" placeholder=""/>
                                        <span
                                            class="tip"><?php _e('Bitte gebe hier z.B. ein Bild an (komplettes HTML-Tag!).', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Inhalt', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <textarea fieldname="media_content"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                    <!-- TABS -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_tabs">
                        <h2><?php _e('Tabs hinzufügen', 'affiliatetheme-backend'); ?></h2>

                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Tab 1', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 2', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 3', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 4', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 5', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 6', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 7', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 8', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 9', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Tab 10', 'affiliatetheme-backend'); ?></label></th>
                                    <td><label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                    <!-- ACCORDIONS -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_accordion">
                        <h2><?php _e('Accordions hinzufügen', 'affiliatetheme-backend'); ?></h2>

                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Auszeichnung', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="accordion_markup">
                                            <option value="default" selected="selected"><?php _e('Accordion', 'affiliatetheme-backend'); ?></option>
                                            <option value="faq"><?php _e('FAQ', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip"><?php _e('Bestimme die Auszeichnung im Frontend. Für FAQ wird die FAQ <a href="https://developers.google.com/search/docs/data-types/faqpage?hl=de" target="_blank">Auszeichung für strukturierte Daten</a> verwendet.', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 1', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 2', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 3', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 4', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 5', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 6', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 7', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 8', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 9', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="toggle-items">
                                    <th><label><?php _e('Toggle 10', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <label><?php _e('Label', 'affiliatetheme-backend'); ?></label><input type="text" value="" fieldname="label"/>
                                        <label><?php _e('Text', 'affiliatetheme-backend'); ?></label><textarea fieldname="text"></textarea>
                                        <label><?php _e('Ausgangszustand', 'affiliatetheme-backend'); ?></label><select fieldname="onload">
                                            <option value=""><?php _e('Geschlossen', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Geöffnet', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                    <!-- BLOGPOSTS -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_blogposts">
                        <h2><?php _e('Blog-Beiträge', 'affiliatetheme-backend'); ?></h2>
                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0" id="posts-table">
                                <tr>
                                    <th><label><?php _e('Anzahl von Beiträgen', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="number" value="" fieldname="limit" placeholder="4"/>
                                        <span class="tip">
                                            <?php _e('Wieviele Beiträge sollen ausgegeben werden?', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Sortieren nach', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="orderby">
                                            <option value="date" selected="selected"><?php _e('Datum', 'affiliatetheme-backend'); ?></option>
                                            <option value="ID"><?php _e('ID', 'affiliatetheme-backend'); ?></option>
                                            <option value="title"><?php _e('Titel', 'affiliatetheme-backend'); ?></option>
                                            <option value="modified"><?php _e('Zuletzt geändert', 'affiliatetheme-backend'); ?></option>
                                            <option value="rand"><?php _e('Zufällig', 'affiliatetheme-backend'); ?></option>
                                            <option value="comment_count"><?php _e('Anzahl Kommentare', 'affiliatetheme-backend'); ?></option>
                                            <option value="menu_order"><?php _e('Menü Reihenfolge', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Reihenfolge', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="order">
                                            <option value="desc" selected="selected"><?php _e('Absteigend', 'affiliatetheme-backend'); ?></option>
                                            <option value="asc"><?php _e('Aufsteigend', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Stil', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="layout">
                                            <option value="small"><?php _e('Thumbnail', 'affiliatetheme-backend'); ?></option>
                                            <option value="large"><?php _e('Large', 'affiliatetheme-backend'); ?></option>
                                            <option value="list"><?php _e('Einfache Liste', 'affiliatetheme-backend'); ?></option>
                                            <option value="grid"><?php _e('Grid', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- end tab -->
                    <!-- PRODUKTE -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_products">
                        <h2><?php _e('Produkte hinzufügen', 'affiliatetheme-backend'); ?></h2>

                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0" id="products-table">
                                <tr>
                                    <th><label><?php _e('Anzahl von Produkten', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="number" value="" fieldname="limit" placeholder="12"/>
                                        <span class="tip">
                                            <?php _e('Wieviele Produkte sollen ausgegeben werden? Diese Option ist nicht<br>
                                            relevant wenn nur ausgewählte Produkte angezeigt werden sollen.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Sortieren nach', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="orderby">
                                            <option value="date" selected="selected"><?php _e('Datum', 'affiliatetheme-backend'); ?></option>
                                            <option value="ID"><?php _e('ID', 'affiliatetheme-backend'); ?></option>
                                            <option value="title"><?php _e('Titel', 'affiliatetheme-backend'); ?></option>
                                            <option value="modified"><?php _e('Zuletzt geändert', 'affiliatetheme-backend'); ?></option>
                                            <option value="rand"><?php _e('Zufällig', 'affiliatetheme-backend'); ?></option>
                                            <option value="comment_count"><?php _e('Anzahl Kommentare', 'affiliatetheme-backend'); ?></option>
                                            <option value="menu_order"><?php _e('Menü Reihenfolge', 'affiliatetheme-backend'); ?></option>
                                            <option value="rating"><?php _e('Bewertung', 'affiliatetheme-backend'); ?></option>
                                            <option value="rating_count"><?php _e('Anzahl der Bewertungen', 'affiliatetheme-backend'); ?></option>
                                            <option value="price"><?php _e('Preis', 'affiliatetheme-backend'); ?></option>
                                            <option value="post__in"><?php _e('Eigene Reihenfolge (include)', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Reihenfolge', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="order">
                                            <option value="desc" selected="selected"><?php _e('Absteigend', 'affiliatetheme-backend'); ?></option>
                                            <option value="asc"><?php _e('Aufsteigend', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Produkte filtern', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <span class="tip"><?php _e('Es können nur bestimmte Produkte angezeigt oder ausgeblendet werden.', 'affiliatetheme-backend'); ?></span>
                                        <select fieldname="products_select" id="products_select">
                                            <option value="" selected="selected"><?php _e('Nichts', 'affiliatetheme-backend'); ?></option>
                                            <option value="include"><?php _e('Auswahl an Produkten anzeigen', 'affiliatetheme-backend'); ?></option>
                                            <option value="exclude"><?php _e('Auswahl an Produkten ausblenden', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Produktauswahl', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <div class="spinner product-select-spinner"></div>
                                        <span class="tip"><?php _e('Bitte im obigen Auswahlfeld eine Auswahl treffen.', 'affiliatetheme-backend'); ?></span>
                                        <select fieldname="include" multiple id="include" class="multiselect" style="display:none;">
                                        </select>
                                        <select fieldname="exclude" multiple id="exclude" class="multiselect" style="display:none;">
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Darstellung', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="layout">
                                            <option value="list" selected="selected"><?php _e('Liste', 'affiliatetheme-backend'); ?></option>
                                            <option value="grid"><?php _e('Grid', 'affiliatetheme-backend'); ?></option>
                                            <option value="grid-hover"><?php _e('Grid mit Hover-Effekt', 'affiliatetheme-backend'); ?></option>
                                            <option value="table-x"><?php _e('Tabelle (X-Achse)', 'affiliatetheme-backend'); ?></option>
                                            <option value="table-y"><?php _e('Tabelle (Y-Achse)', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="display:none;">
                                    <th><label><?php _e('Eigene Bewertung', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="review">
                                            <option value="false" selected="selected"><?php _e('Ausblenden', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Anzeigen', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip">
                                            <?php _e('Mit diesem Parameter kannst du für die Tabellen-Layouts (X/Y) die „Eigenen Bewertungen“ als eigene Spalte anzeigen lassen.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr style="display:none;">
                                    <th><label><?php _e('Preisvergleich anzeigen', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="price_compare">
                                            <option value="false" selected="selected"><?php _e('Ausblenden', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Anzeigen', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip">
                                            <?php _e('Mit diesem Parameter kannst du für die Tabellen-Layouts (X) den „Preisvergleich“ als eigene Spalte anzeigen lassen.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Button: Detail', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="detail_button">
                                            <option value="true" selected="selected"><?php _e('Anzeigen', 'affiliatetheme-backend'); ?></option>
                                            <option value="false"><?php _e('Ausblenden', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Button: Kaufen', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="buy_button">
                                            <option value="true" selected="selected"><?php _e('Anzeigen', 'affiliatetheme-backend'); ?></option>
                                            <option value="false"><?php _e('Ausblenden', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Eigenschaften', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="details_fields">
                                            <option value="true" selected="selected"><?php _e('Anzeigen', 'affiliatetheme-backend'); ?></option>
                                            <option value="false"><?php _e('Ausblenden', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Taxonomien', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="details_tax">
                                            <option value="true" selected="selected"><?php _e('Anzeigen', 'affiliatetheme-backend'); ?></option>
                                            <option value="false"><?php _e('Ausblenden', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Minimaler Preis', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="number" value="" fieldname="price_min" placeholder=""/>
                                        <span class="tip">
                                            <?php _e('Mit diesem Filter kannst du z.B. Produkte ab einem Preis von xx.xx Euro ausgeben.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Maximaler Preis', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="number" value="" fieldname="price_max" placeholder=""/>
                                        <span class="tip">
                                            <?php _e('Mit diesem Filter kannst du z.B. Produkte bis zu einem Preis von xx.xx Euro ausgeben.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Nur Angebote', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="reduced">
                                            <option value="false" selected="selected"><?php _e('Nein, alle Produkte anzeigen.', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Ja, nur Angebote anzeigen!', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip">
                                            <?php _e('Mit dieser Option kannst du deine Ausgabe auf Angebote (mit Streichpreis) beschränken.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr style="display:none;">
                                    <th><label><?php _e('Ausrichtung', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="align">
                                            <option value="left" selected="selected"><?php _e('Linksbündig', 'affiliatetheme-backend'); ?></option>
                                            <option value="right"><?php _e('Rechtsbündig', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip">
                                            <?php _e('Diese Option greift nur, wenn maximal 1 Produkt ausgegeben wird. Du kannst das Produkt
                                            dann z.B. Links oder Rechtsbündig vom Text darstellen lassen. Beachte das dies natürlich nur mit dem Grid-Layout
                                            funktionieren kann.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Slider', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="slider">
                                            <option value="false" selected="selected"><?php _e('Deaktivieren', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Aktivieren', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip">
                                            <?php _e('Wenn du den Slider aktivierst, wird automatisch das Grid-Layout aktiviert.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                    <!-- INFOBOX -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_infobox">
                        <h2><?php _e('Infobox', 'affiliatetheme-backend'); ?></h2>

                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Produktauswahl (optional)', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <div class="spinner product-select-spinner"></div>
                                        <span class="tip"><?php _e('Wenn du den Shortcode auf einer Produktseite ausgibst, wird die Infobox des aktuellen Produktes verwendet. Natürlich kannst du aber auf jeder beliebigen Seite die Infobox eines gewünschten Produktes ausgeben. Dazu wähle hier im Dropdown einfach das Produkt aus.', 'affiliatetheme-backend'); ?></span>
                                        <select fieldname="id" id="simple-product-select"></select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                    <!-- PREISVERGLEICH -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_price_compare">
                        <h2><?php _e('Preisvergleich', 'affiliatetheme-backend'); ?></h2>

                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Produktauswahl (optional)', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <div class="spinner product-select-spinner"></div>
                                        <span class="tip"><?php _e('Wenn du den Shortcode auf einer Produktseite ausgibst, wird der Preisvergleich des aktuellen Produktes verwendet. Natürlich kannst du aber auf jeder beliebigen Seite den Preisvergleich eines gewünschten Produktes ausgeben. Dazu wähle hier im Dropdown einfach das Produkt aus.', 'affiliatetheme-backend'); ?></span>
                                        <select fieldname="id" id="simple-product-select2"></select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                    <!-- RESPONSIVE CONTENT -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_responsive">
                        <h2><?php _e('Responsive Content', 'affiliatetheme-backend'); ?></h2>
                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Aktion', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="aktion">
                                            <option value="visible" selected="selected"><?php _e('Anzeigen', 'affiliatetheme-backend'); ?></option>
                                            <option value="hidden"><?php _e('Verstecken', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip"><?php _e('Was soll mit dem Inhalt geschehen? Er kann versteckt oder angezeigt werden', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Devices', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="screen" multiple>
                                            <option value="xs"><?php _e('Smartphone', 'affiliatetheme-backend'); ?></option>
                                            <option value="sm"><?php _e('Tablets', 'affiliatetheme-backend'); ?></option>
                                            <option value="md"><?php _e('Notebooks / kleinere Desktops', 'affiliatetheme-backend'); ?></option>
                                            <option value="lg"><?php _e('Desktops', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip"><?php _e('Wähle hier aus, auf welchen Devices der Inhalt versteckt/angezeigt werden soll.', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Stil', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="display">
                                            <option value="block"><?php _e('Block', 'affiliatetheme-backend'); ?></option>
                                            <option value="inline"><?php _e('Inline', 'affiliatetheme-backend'); ?></option>
                                            <option value="inline-block"><?php _e('Inline-Block', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                        <span class="tip"><?php _e('Gilt nur für "Anzeigen". Wenn du innerhalb eines Textes besimmte Wörter ausblenden/anzeigen willst, wähle hier "Inline". Wenn du Block wählst, bricht der Inhalt in einen Absatz um.', 'affiliatetheme-backend'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Inhalt', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <textarea fieldname="responsive_content"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- end tab -->
                    <!-- Taxonomy List -->
                    <div class="endcore-shortcodes-form-tab" id="endcore-shortcodes-form-tab_taxonomyimages">
                        <h2><?php _e('Taxonomie-Bilder', 'affiliatetheme-backend'); ?></h2>

                        <div class="endcore-shortcodes-form-fields">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><label><?php _e('Taxonomie', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="taxonomy">
                                            <?php
                                            $taxonomies = get_object_taxonomies('product', 'objects');
                                            if($taxonomies) {
                                                foreach($taxonomies as $tax) {
                                                    echo '<option value="' . $tax->name . '">' . $tax->labels->name . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">' . __('Es wurden keine Taxonomien gefunden.', 'affiliatetheme-backend') . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span class="tip">
                                            <?php _e('Aus welcher Taxonomie sollen die Einträge gezogen werden?', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Anzahl von Einträgen', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input type="number" value="" fieldname="number" placeholder=""/>
                                        <span class="tip">
                                            <?php _e('Wieviele Einträge sollen ausgegeben werden? Kein Wert steht für alle!', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Sortieren nach', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="orderby">
                                            <option value="name" selected><?php _e('Name', 'affiliatetheme-backend'); ?></option>
                                            <option value="id"><?php _e('ID', 'affiliatetheme-backend'); ?></option>
                                            <option value="count"><?php _e('Anzahl der Produkte', 'affiliatetheme-backend'); ?></option>
                                            <option value="slug"><?php _e('Slug (URL)', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Reihenfolge', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="order">
                                            <option value="desc" selected="selected"><?php _e('Absteigend', 'affiliatetheme-backend'); ?></option>
                                            <option value="asc"><?php _e('Aufsteigend', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Leere Einträge ignorieren', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="hide_empty">
                                            <option value="1" selected="selected"><?php _e('Ja', 'affiliatetheme-backend'); ?></option>
                                            <option value="0"><?php _e('Nein', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Bestimmte Einträge ignorieren', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input fieldname="exclude" value="" />
                                        <span class="tip">
                                            <?php _e('Wenn du bestimmte Einträge filteren möchtest, kannst du hier die ID(s) kommasepariert angeben.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Nur Bestimmte Einträge anzeigen', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <input fieldname="include" value="" />
                                        <span class="tip">
                                            <?php _e('Wenn du nur bestimmte Einträge anzeigen möchtest, kannst du hier die ID(s) kommasepariert angeben.', 'affiliatetheme-backend'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php _e('Einträge ohne Bilder ignorieren', 'affiliatetheme-backend'); ?></label></th>
                                    <td>
                                        <select fieldname="without_images">
                                            <option value="false" selected="selected"><?php _e('Nein', 'affiliatetheme-backend'); ?></option>
                                            <option value="true"><?php _e('Ja', 'affiliatetheme-backend'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end tab -->
                </div>
            </div>
            <div class="endcore-shortcodes-submit">
                <input style="display:none" id="endcore-shortcodes-form-type" value="button"/>
                <textarea style="display:none" id="endcore-shortcodes-form-code-to-add"></textarea>
                <input type="button" id="endcore_shortcodes-submit" class="button-primary" value="<?php _e('Shortcode einfügen', 'affiliatetheme-backend'); ?>" name="submit"/>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        /**
        * Global vars
        *
        */
        var form = jQuery('#endcore-shortcodes-form');
        var endcore_shortcode_type = "grid";
        var endcore_shortcode_code = "";
        var shortcode_window = jQuery('#TB_window .endcore-shortcodes-form-fields');
        var tb_window = jQuery('#TB_window');
        var new_height = tb_window.height() - 130;

        /**
         * onLoad
         */
        shortcode_window.height(new_height + 'px');
        tb_window.addClass('at-shortcode-generator');

        /**
         * Function
         * get multiselect
         */
        jQuery('#products_select').change(function() {
            var target = jQuery(this).val();
            get_products_select(target, true);
        });

        /**
         * Produktauswahl
         */
        function get_products_select(target, multiselect, blank) {
            var multiselect = (multiselect ? multiselect : '');
            var blank = (blank ? blank : '');

            if(multiselect == true)
                jQuery('.ui-multiselect').remove();

            if(target == '')
                return false;

            if(multiselect == true)
                jQuery('div.product-select-spinner').css('visibility', 'visible');

            jQuery.get( ajaxurl + "?action=at_get_filter_products", function( data ) {}).done(function(data) {
                if(blank == true)
                    data = '<option value=""></opion>' + data;

                jQuery('#' + target).html(data);

                if(multiselect == true)
                    jQuery('#' + target).multiSelect();
            }).fail(function() {
                jQuery('#' + target).html('<p>Es ist ein Fehler aufgetreten.</p>');
            }).always(function() {
                if(multiselect == true)
                    jQuery('div.product-select-spinner').css('visibility', 'hidden');
            });
        }

        /**
         *  Hide some fields
         */
        jQuery('select[fieldname="layout"]').change(function() {
            var value = jQuery(this).val();

            if(value == 'table-x') {
                jQuery('select[fieldname="price_compare"]').parent().parent().show();
            } else {
                jQuery('select[fieldname="price_compare"]').parent().parent().hide();
            }

            if(value == 'table-x' || value == 'table-y') {
                jQuery('select[fieldname="details_tax"]').parent().parent().hide();
                jQuery('select[fieldname="review"]').parent().parent().show();
            } else {
                jQuery('select[fieldname="details_tax"]').parent().parent().show();
                jQuery('select[fieldname="review"]').parent().parent().hide();
            }

            if(value == 'grid' || value == 'grid-hover') {
                jQuery('select[fieldname="align"]').parent().parent().show();
            } else {
                jQuery('select[fieldname="align"]').parent().parent().hide();
            }
        });

        /**
        * Function
        * change shortcode tabs
        */
        jQuery('.endcore-shortcodes-form-types ul li a').click(function(){
            endcore_shortcode_type = jQuery(this).parent('li').attr('type');
            jQuery('input#endcore-shortcodes-form-type').val(endcore_shortcode_type);
            jQuery('.endcore-shortcodes-form-tab').hide();
            jQuery('#endcore-shortcodes-form-tab_'+endcore_shortcode_type).show();
            jQuery('.endcore-shortcodes-form-types .active').removeClass('active');
            jQuery(this).parent('li').addClass('active');
            jQuery('.endcore-shortcodes-form .endcore-shortcodes-form-types').css({"height":jQuery('.endcore-shortcodes-form-tabs').outerHeight()});
            return false;
        });

        /**
         * Function
         * Grids
         */
        var num_of_columns = 2;
        jQuery('.column-structures a').click(function() {
            jQuery('.column-structures a').removeClass('active');
            jQuery(this).addClass('active');
            jQuery('.column-structures input').val(jQuery(this).attr('split'));
            num_of_columns = jQuery(this).attr('split');
            num_of_columns = num_of_columns.split('|');
            num_of_columns = num_of_columns.length;

            jQuery('#endcore-shortcodes-form-tab_grid textarea').attr({'disabled':'disabled'});
            var i = -1;
            while(i < (num_of_columns - 1)) {
                i++;
                jQuery('#endcore-shortcodes-form-tab_grid textarea').eq(i).removeAttr('disabled');
            }

            return false;
        });

        /**
        * Function
        * shortcode form submit
        */
        form.find('#endcore_shortcodes-submit').click(function(){
            endcore_shortcode_code = '';
            console.log(endcore_shortcode_type);
            if(endcore_shortcode_type == "products") {
                /**
                 * Produkte Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '[produkte ';


                jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' input, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' select, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {

                    if(jQuery(this).attr('fieldname') != "" && jQuery(this).attr('fieldname') != undefined && jQuery(this).attr('fieldname') != "products_select") {
                        if(jQuery(this).val() !== undefined && jQuery(this).val() !== "" && jQuery(this).val() !== null) {
                            endcore_shortcode_code = endcore_shortcode_code + ' ' + jQuery(this).attr('fieldname') + '="' + jQuery(this).val() + '"';
                        }
                    }

                });
                endcore_shortcode_code = endcore_shortcode_code + ']';
            } if(endcore_shortcode_type == "infobox") {
                /**
                 * Infobox Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '[infobox ';


                jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' input, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' select, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {

                    if(jQuery(this).attr('fieldname') != "" && jQuery(this).attr('fieldname') != undefined) {
                        if(jQuery(this).val() !== undefined && jQuery(this).val() !== "" && jQuery(this).val() !== null) {
                            endcore_shortcode_code = endcore_shortcode_code + ' ' + jQuery(this).attr('fieldname') + '="' + jQuery(this).val() + '"';
                        }
                    }

                });
                endcore_shortcode_code = endcore_shortcode_code + ']';
            } else if(endcore_shortcode_type == "price_compare") {
                /**
                 * Preisvergleich Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '[preisvergleich ';


                jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' input, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' select, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {

                    if(jQuery(this).attr('fieldname') != "" && jQuery(this).attr('fieldname') != undefined) {
                        if(jQuery(this).val() !== undefined && jQuery(this).val() !== "" && jQuery(this).val() !== null) {
                            endcore_shortcode_code = endcore_shortcode_code + ' ' + jQuery(this).attr('fieldname') + '="' + jQuery(this).val() + '"';
                        }
                    }

                });
                endcore_shortcode_code = endcore_shortcode_code + ']';
            } else if(endcore_shortcode_type == "grid") {
                /**
                 * Grid Shortcode
                 */
                var columns = jQuery('.column-structures').find('.active').attr('split');
                var col_counter = 0;
                var col_var = 0;

                if(columns == "50|50") {
                    col_var = "6";

                    endcore_shortcode_code = endcore_shortcode_code + '[row]';
                    jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                        if(jQuery(this).attr('disabled') == "disabled") { } else {
                            col_counter++;
                            endcore_shortcode_code = endcore_shortcode_code + '[col class="col-sm-'+col_var+'"]' + jQuery(this).val() + '[/col]';
                        }
                    });
                    endcore_shortcode_code = endcore_shortcode_code + '[/row]';
                } else if(columns == "33|33|33") {
                    col_var = "4";

                    endcore_shortcode_code = endcore_shortcode_code + '[row]';
                    jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                        if(jQuery(this).attr('disabled') == "disabled") { } else {
                            col_counter++;
                            endcore_shortcode_code = endcore_shortcode_code + '[col class="col-sm-'+col_var+'"]' + jQuery(this).val() + '[/col]';
                        }
                    });
                    endcore_shortcode_code = endcore_shortcode_code + '[/row]';
                } else if(columns == "67|33") {
                    col_var = "8";

                    endcore_shortcode_code = endcore_shortcode_code + '[row]';
                    jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                        if(jQuery(this).attr('disabled') == "disabled") { } else {
                            col_counter++;
                            if(col_counter == "2") col_var = "4";
                            endcore_shortcode_code = endcore_shortcode_code + '[col class="col-sm-'+col_var+'"]' + jQuery(this).val() + '[/col]';
                        }
                    });
                    endcore_shortcode_code = endcore_shortcode_code + '[/row]';
                } else if(columns == "33|67") {
                    col_var = "4";

                    endcore_shortcode_code = endcore_shortcode_code + '[row]';
                    jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                        if(jQuery(this).attr('disabled') == "disabled") { } else {
                            col_counter++;
                            if(col_counter == "2") col_var = "8";
                            endcore_shortcode_code = endcore_shortcode_code + '[col class="col-sm-'+col_var+'"]' + jQuery(this).val() + '[/col]';
                        }
                    });
                    endcore_shortcode_code = endcore_shortcode_code + '[/row]';
                } else if(columns == "25|25|25|25") {
                    col_var = "3";

                    endcore_shortcode_code = endcore_shortcode_code + '[row]';
                    jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                        if(jQuery(this).attr('disabled') == "disabled") { } else {
                            col_counter++;
                            endcore_shortcode_code = endcore_shortcode_code + '[col class="col-sm-'+col_var+'"]' + jQuery(this).val() + '[/col]';
                        }
                    });
                    endcore_shortcode_code = endcore_shortcode_code + '[/row]';
                } else if(columns == "50|25|25") {
                    col_var = "6";

                    endcore_shortcode_code = endcore_shortcode_code + '[row]';
                    jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                        if(jQuery(this).attr('disabled') == "disabled") { } else {
                            col_counter++;
                            if(col_counter == "2" || col_counter == "3") col_var = "3";
                            endcore_shortcode_code = endcore_shortcode_code + '[col class="col-sm-'+col_var+'"]' + jQuery(this).val() + '[/col]';
                        }
                    });
                    endcore_shortcode_code = endcore_shortcode_code + '[/row]';
                } else if(columns == "25|25|50") {
                    col_var = "3";

                    endcore_shortcode_code = endcore_shortcode_code + '[row]';
                    jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                        if(jQuery(this).attr('disabled') == "disabled") { } else {
                            col_counter++;
                            if(col_counter == "3") col_var = "6";
                            endcore_shortcode_code = endcore_shortcode_code + '[col class="col-sm-'+col_var+'"]' + jQuery(this).val() + '[/col]';
                        }
                    });
                    endcore_shortcode_code = endcore_shortcode_code + '[/row]';
                } else if(columns == "25|50|25") {
                    col_var = "3";

                    endcore_shortcode_code = endcore_shortcode_code + '[row]';
                    jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                        if(jQuery(this).attr('disabled') == "disabled") { } else {
                            col_counter++;
                            if(col_counter == "2") col_var = "6";
                            if(col_counter == "3") col_var = "3";
                            endcore_shortcode_code = endcore_shortcode_code + '[col class="col-sm-'+col_var+'"]' + jQuery(this).val() + '[/col]';
                        }
                    });
                    endcore_shortcode_code = endcore_shortcode_code + '[/row]';
                }
            } else if(endcore_shortcode_type == "button") {
                /**
                 * Button Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '[button';
                endcore_shortcode_code = endcore_shortcode_code + ' color="' + jQuery('select[fieldname=button_color]').val() + '"';
                endcore_shortcode_code = endcore_shortcode_code + ' size="' + jQuery('select[fieldname=button_size]').val() + '"';
                endcore_shortcode_code = endcore_shortcode_code + ' shape="' + jQuery('select[fieldname=button_shape]').val() + '"';
                endcore_shortcode_code = endcore_shortcode_code + ' outline="' + jQuery('select[fieldname=button_outline]').val() + '"';
                endcore_shortcode_code = endcore_shortcode_code + ' block="' + jQuery('select[fieldname=button_block]').val() + '"';
                if(jQuery('input[fieldname=button_icon]').val()) {
                    endcore_shortcode_code = endcore_shortcode_code + ' icon="' + jQuery('input[fieldname=button_icon]').val() + '"';
                    endcore_shortcode_code = endcore_shortcode_code + ' icon_position="' + jQuery('select[fieldname=button_icon_pos]').val() + '"';
                }
                endcore_shortcode_code = endcore_shortcode_code + ' target="' + jQuery('select[fieldname=button_target]').val() + '"';
                endcore_shortcode_code = endcore_shortcode_code + ' rel="' + jQuery('select[fieldname=button_rel]').val() + '"';
                if(jQuery('input[fieldname=button_href]').val()) {
                    endcore_shortcode_code = endcore_shortcode_code + ' href="' + jQuery('input[fieldname=button_href]').val() + '"';
                }
                if(jQuery('input[fieldname=button_class]').val()) {
                    endcore_shortcode_code = endcore_shortcode_code + ' class="' + jQuery('input[fieldname=button_class]').val() + '"';
                }
                endcore_shortcode_code = endcore_shortcode_code + ']';
                if(jQuery('input[fieldname=button_text]').val()) {
                    endcore_shortcode_code = endcore_shortcode_code + jQuery('input[fieldname=button_text]').val();
                }
                endcore_shortcode_code = endcore_shortcode_code + '[/button]'

            } else if(endcore_shortcode_type == "alert") {
                /**
                 * Alert Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '[alert style="'+jQuery('select[fieldname=alert_style]').val()+'"';
                endcore_shortcode_code = endcore_shortcode_code +  ']' + jQuery('textarea[fieldname=alert_content]').val() + '[/alert]';

            } else if(endcore_shortcode_type == "media") {
                /**
                 * Media Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '[media]';

                if(jQuery('select[fieldname=media_style]').val() == 'left') {
                    endcore_shortcode_code = endcore_shortcode_code + '[media_object style="left"';
                    endcore_shortcode_code = endcore_shortcode_code + ' aligned="'+jQuery('select[fieldname=media_aligned]').val()+'"]';
                    endcore_shortcode_code = endcore_shortcode_code + jQuery('input[fieldname=media_object]').val();
                    endcore_shortcode_code = endcore_shortcode_code + '[/media_object]';
                }

                endcore_shortcode_code = endcore_shortcode_code + '[media_body] ' + jQuery('textarea[fieldname=media_content]').val() + '[/media_body]';

                if(jQuery('select[fieldname=media_style]').val() == 'right') {
                    endcore_shortcode_code = endcore_shortcode_code + '[media_object style="right"';
                    endcore_shortcode_code = endcore_shortcode_code + ' aligned="'+jQuery('select[fieldname=media_aligned]').val()+'"]';
                    endcore_shortcode_code = endcore_shortcode_code + jQuery('input[fieldname=media_object]').val();
                    endcore_shortcode_code = endcore_shortcode_code + '[/media_object]';
                }

                endcore_shortcode_code = endcore_shortcode_code + '[/media]';
            } else if(endcore_shortcode_type == "tabs") {
                /**
                 * Tabs Shortcode
                 */
                var tab_id = Math.floor((Math.random() * 1000) + 1); /* Random Tab Number */
                var tab_titles = new Array();

                jQuery('#endcore-shortcodes-form-tab_tabs input[fieldname="label"]').each(function(){
                    tab_titles.push(jQuery(this).val());
                });
                tab_titles = jQuery.grep(tab_titles,function(n){ return(n) });
                tab_titles.toString();

                endcore_shortcode_code = endcore_shortcode_code + '[tabs style="tab" id="' + tab_id + '" title="' + tab_titles + '"]';
                var i=1;
                jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' input').each(function() {
                    if(jQuery(this).val() != "") {
                        endcore_shortcode_code = endcore_shortcode_code + '[tab id="' + i + '" tid="' + tab_id + '"]' + jQuery(this).parent('td').find('textarea').val() + '[/tab]';
                        i++;
                    }

                });
                endcore_shortcode_code = endcore_shortcode_code + '[/'+ endcore_shortcode_type + ']';
            } else if(endcore_shortcode_type == "accordion") {
                /**
                 * Accordion Shortcode
                 */
                var toggle_id = Math.floor((Math.random() * 1000) + 1);
                var markup = jQuery(this).parent().parent().find('select[fieldname="accordion_markup"]').val();

                endcore_shortcode_code = endcore_shortcode_code + '[accordiongroup id="'+ toggle_id + '" markup="' + markup + '"]';
                jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' tr.toggle-items').each(function() {
                    if(jQuery(this).find('textarea').val() != "") {
                        endcore_shortcode_code = endcore_shortcode_code + '[accordion group="' + toggle_id + '" title="' + jQuery(this).find('input[fieldname="label"]').val() + '" active="' + jQuery(this).find('select').val() + '"]' + jQuery(this).find('textarea').val() + '[/accordion]';

                    }
                });

                endcore_shortcode_code = endcore_shortcode_code + '[/accordiongroup]';
            } else if(endcore_shortcode_type == "responsive") {
                /**
                 * Responsive Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '['+ jQuery(this).parent().parent().find('select[fieldname=aktion]').val();
                jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' input, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' select, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {
                    if(jQuery(this).attr('fieldname') != "" && jQuery(this).attr('fieldname') != undefined && jQuery(this).attr('fieldname') != "aktion" && jQuery(this).attr('fieldname') != "responsive_content") {
                        endcore_shortcode_code = endcore_shortcode_code + ' ' + jQuery(this).attr('fieldname') + '="' + jQuery(this).val() + '"';
                    }
                });
                endcore_shortcode_code = endcore_shortcode_code +  ']' + jQuery('textarea[fieldname=responsive_content]').val() + '[/'+ jQuery(this).parent().parent().find('select[fieldname=aktion]').val() +']';

            } else if(endcore_shortcode_type == "blogposts") {
                /**
                 * Blogposts Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '[blogposts ';


                jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' input, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' select, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {

                    if(jQuery(this).attr('fieldname') != "" && jQuery(this).attr('fieldname') != undefined) {
                        if(jQuery(this).val() !== undefined && jQuery(this).val() !== "" && jQuery(this).val() !== null) {
                            endcore_shortcode_code = endcore_shortcode_code + ' ' + jQuery(this).attr('fieldname') + '="' + jQuery(this).val() + '"';
                        }
                    }

                });
                endcore_shortcode_code = endcore_shortcode_code + ']';
            } else if(endcore_shortcode_type == "taxonomyimages") {
                /**
                 * Taxonomy List Shortcode
                 */
                endcore_shortcode_code = endcore_shortcode_code + '[taxonomy_images ';


                jQuery('#endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' input, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' select, #endcore-shortcodes-form-tab_' + endcore_shortcode_type + ' textarea').each(function() {

                    if(jQuery(this).attr('fieldname') != "" && jQuery(this).attr('fieldname') != undefined) {
                        if(jQuery(this).val() !== undefined && jQuery(this).val() !== "" && jQuery(this).val() !== null) {
                            endcore_shortcode_code = endcore_shortcode_code + ' ' + jQuery(this).attr('fieldname') + '="' + jQuery(this).val() + '"';
                        }
                    }

                });
                endcore_shortcode_code = endcore_shortcode_code + ']';
            }

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, endcore_shortcode_code);
            tb_remove();

            return false;
        });

        /*
         * Taxonomien
         */
        function get_products_taxonomies() {
            var acs_action = '';
            jQuery.get( ajaxurl + "?action=at_get_products_multiselect_tax", function( data ) {
                jQuery('#products-table').append(data);
            });
        }

        function get_posts_taxonomies() {
            var acs_action = '';
            jQuery.get( ajaxurl + "?action=at_get_posts_multiselect_tax", function( data ) {
                jQuery('#posts-table').append(data);
            });
        }

        /*
         * Höhe des Shortcode Generators anpassen
         */
        function set_shortcode_window_height() {
            var shortcode_window = jQuery('#TB_window .endcore-shortcodes-form-fields');
            var tb_window = jQuery('#TB_window');
            var new_height = tb_window.height() - 130;

            shortcode_window.height(new_height + 'px');
        }

        jQuery(document).ready(function(){
            get_products_taxonomies();
            get_posts_taxonomies();

            get_products_select('simple-product-select', false, true);
            get_products_select('simple-product-select2', false, true);
        });

        jQuery(window).resize(function() {
            set_shortcode_window_height();
        });

        set_shortcode_window_height();
    </script>

    <?php
    exit();
}