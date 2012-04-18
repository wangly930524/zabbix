<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#showsla').bind('click', function() {
			if (this.checked) {
				jQuery('#goodsla').prop('disabled', false);
			}
			else {
				jQuery('#goodsla').prop('disabled', true);
			}
		});

		jQuery('#add_service_time').bind('click', function() {
			var input = document.createElement('input');
			input.setAttribute('type', 'hidden');
			input.setAttribute('name', 'add_service_time');
			input.setAttribute('value', 1);
			jQuery('form[name=servicesForm]').append(input);
			jQuery('form[name=servicesForm]').submit();
		});
	});

	function add_child_service(name, serviceid, trigger, triggerid) {
		if (jQuery('#children_' + serviceid + '_serviceid').attr('id') == null) {
			var tr = document.createElement('tr');
			tr.setAttribute('id', 'children_' + serviceid);

			// column "name"
			var td = document.createElement('td');
			var inputServiceId = document.createElement('input');
			inputServiceId.setAttribute('type', 'hidden');
			inputServiceId.setAttribute('value', serviceid);
			inputServiceId.setAttribute('name', 'children[' + serviceid + '][serviceid]');
			inputServiceId.setAttribute('id', 'children_' + serviceid + '_serviceid');

			var inputName = document.createElement('input');
			inputName.setAttribute('type', 'hidden');
			inputName.setAttribute('value', name);
			inputName.setAttribute('name', 'children[' + serviceid + '][name]');
			inputName.setAttribute('id', 'children_' + serviceid + '_name');

			var inputTrigger = document.createElement('input');
			inputTrigger.setAttribute('type', 'hidden');
			inputTrigger.setAttribute('value', triggerid);
			inputTrigger.setAttribute('name', 'children[' + serviceid + '][triggerid]');

			var url = document.createElement('a');
			url.setAttribute('href', 'services.php?form=1&serviceid=' + serviceid);
			url.appendChild(document.createTextNode(name));

			td.appendChild(inputServiceId);
			td.appendChild(inputName);
			td.appendChild(inputTrigger);
			td.appendChild(url);
			tr.appendChild(td);

			// column "soft"
			var td = document.createElement('td');
			var softCheckbox = document.createElement('input');
			softCheckbox.setAttribute('type', 'checkbox');
			softCheckbox.setAttribute('value', '1');
			softCheckbox.setAttribute('name', 'children[' + serviceid + '][soft]');
			softCheckbox.setAttribute('class', 'input checkbox pointer')

			td.appendChild(softCheckbox);
			tr.appendChild(td);

			// column "trigger"
			var td = document.createElement('td');
			td.appendChild(document.createTextNode(trigger));
			tr.appendChild(td);

			// column "action"
			var td = document.createElement('td');
			var inputRemove = document.createElement('input');
			inputRemove.setAttribute('type', 'button');
			inputRemove.setAttribute('value', '<?php echo _('Remove'); ?>');
			inputRemove.setAttribute('class', 'link_menu');
			inputRemove.setAttribute('onclick', 'javascript: removeDependentChild(\'' + serviceid + '\');');

			td.appendChild(inputRemove);
			tr.appendChild(td);
			document.getElementById('service_children').firstChild.appendChild(tr);
			jQuery('#service_children .message').css('display', 'none');
		}
	}

	function removeDependentChild(serviceid) {
		removeObjectById('children_' + serviceid);
		removeObjectById('children_' + serviceid + '_name');
		removeObjectById('children_' + serviceid + '_serviceid');
		removeObjectById('children_' + serviceid + '_triggerid');
	}

	function removeTime(id) {
		removeObjectById('times_' + id);
		removeObjectById('times_' + id + '_type');
		removeObjectById('times_' + id + '_from');
		removeObjectById('times_' + id + '_to');
		removeObjectById('times_' + id + '_note');
	}
</script>
