<?php

/**
 * @file
 * Latto's theme implementation to display page nodes.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $date
 *  (NOTE: modified for latto during latto_preprocess_node in templates.php)
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * Latto specific variables:
 * - $latto_updated: Information about latest update on the node created
 *  from $date during latto_preprocess_node().
 * - $latto_ding_content_tags: Tags, as a comma-separated list of
 *  links with leading text "Tags: " as relevant for the event node
 * - $latto_byline: outputs byline to be used before $name
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>
<section class="span7" role="main">
  <?php  if ($page) : ?>
  <article>
    <?php print render($content['field_ding_page_titel_image'][0]); ?>
 <hr/>
    <header class="page-header">
       <h1><?php print $title; ?></h1>
        <div class="row-fluid">
            <div class="lead span8">
                <p><?php print render($content['field_ding_page_lead'][0]); ?></p>
            </div>
        </div>
    </header>
  </article>
 <?php endif; ?>
 
  <?php  if ($teaser) : ?>
       <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
        <div class="row-fluid">
            <div class="lead span8">
                <p><?php print render($content['field_ding_page_lead'][0]); ?></p>
            </div>
        </div>
  <?php endif; ?>

    <?php
      // Hide fields we have already rendered.
      hide($content['field_ding_page_titel_image']);
      hide($content['field_ding_page_lead']);
      // Hide fields that will be displayed as panel panes instead.
      hide($content['comments']);
      // Hide fields now so that we can render them later.
      hide($content['links']);
      hide($content['field_ding_page_tags']);
      print render($content);
    ?>

  <hr />

  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) :
      unset($content['links']['comment']['#links']['comment-add']);
    endif;
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>
<?php  if ($page) : ?>
  <?php if ($display_submitted): ?>
    <footer class="row-fluid">
      <?php print $user_picture; ?>
      <div class="span10">
        <h4>
          <?php print $latto_byline; ?>
          <?php print $name; ?>
        </h4>
        <p>
          <i class="icon-time"></i>
          <?php print $submitted; ?> • <?php print $latto_updated; ?>
          <?php if ($ddbasic_ding_page_tags): ?>
            <br />
            <span class="tags">
              <i class="icon-tag"></i>
              <?php print t('Tags: ') . $ddbasic_ding_page_tags; ?>
            </span>
          <?php endif; ?>
        </p>
      </div>
    </footer>
  <?php endif; ?>
<?php endif; ?>
</section>
