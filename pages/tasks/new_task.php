<?php
/**
 * Create a new task
 *
 * @package ElggTasks
 */

gatekeeper();

$container_guid = (int) get_input('guid');
$container = get_entity($container_guid);
if (!$container) {

}


if (elgg_instanceof($container, 'object', 'tasklist')) {
	$list_guid = $container->getGUID();
	$page_owner = $container->getContainerEntity();

} else {
	$list_guid = 0;
	$page_owner = $container;
}

elgg_set_page_owner_guid($page_owner->getGUID());

elgg_push_breadcrumb($container->name, $container->getURL());

$title = elgg_echo('tasks:add');
elgg_push_breadcrumb($title);

$vars = task_prepare_form_vars();
$content = elgg_view_form('tasks/edit', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
