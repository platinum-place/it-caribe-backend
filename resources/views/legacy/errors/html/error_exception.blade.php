@php $error_id = uniqid('error', true); @endphp
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">

	<title>{{ $title }}</title>
	<style type="text/css">
		{{ preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) }}
	</style>

	<script type="text/javascript">
		{{ file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.js') }}
	</script>
</head>
<body onload="init()">

	<!-- Header -->
	<div class="header">
		<div class="container">
			<h1>{{ esc($title), esc($exception->getCode() ? ' #' . $exception->getCode() : '') }}</h1>
			<p>
				{{ nl2br(esc($exception->getMessage())) }}
				<a href="https://www.duckduckgo.com/?q={{ urlencode($title . ' ' . preg_replace('#\'.*\'|".*"#Us', '', $exception->getMessage())) }}"
				   rel="noreferrer" target="_blank">search &rarr;</a>
			</p>
		</div>
	</div>

	<!-- Source -->
	<div class="container">
		<p><b>{{ esc(static::cleanPath($file, $line)) }}</b> at line <b>{{ $line }}</b></p>

		@if (is_file($file))
			<div class="source">
				{{ static::highlightFile($file, $line, 15); }}
			</div>
		{{ endif; }}
	</div>

	<div class="container">

		<ul class="tabs" id="tabs">
			<li><a href="#backtrace">Backtrace</a></li>
			<li><a href="#server">Server</a></li>
			<li><a href="#request">Request</a></li>
			<li><a href="#response">Response</a></li>
			<li><a href="#files">Files</a></li>
			<li><a href="#memory">Memory</a></li>
		</ul>

		<div class="tab-content">

			<!-- Backtrace -->
			<div class="content" id="backtrace">

				<ol class="trace">
				@foreach ($trace as $index => $row)

					<li>
						<p>
							<!-- Trace info -->
							@if (isset($row['file']) && is_file($row['file']))
								@php
                                if (isset($row['function']) && in_array($row['function'], ['include', 'include_once', 'require', 'require_once'], true)) {
                                    echo esc($row['function'] . ' ' . static::cleanPath($row['file']));
                                } else {
                                    echo esc(static::cleanPath($row['file']) . ' : ' . $row['line']);
                                }
                                @endphp
							@else
								{PHP internal code}
							{{ endif; }}

							<!-- Class/Method -->
							@if (isset($row['class']))
								&nbsp;&nbsp;&mdash;&nbsp;&nbsp;{{ $row['class'] . $row['type'] . $row['function'] }}
								@if (! empty($row['args']))
									{{ $args_id = $error_id . 'args' . $index }}
									( <a href="#" onclick="return toggle('{{ $args_id, 'attr' }}');">arguments</a> )
									<div class="args" id="{{ $args_id, 'attr' }}">
										<table cellspacing="0">

										@php
                                        $params = null;
                                        // Reflection by name is not available for closure function
                                        if (substr($row['function'], -1) !== '}') {
                                            $mirror = isset($row['class']) ? new \ReflectionMethod($row['class'], $row['function']) : new \ReflectionFunction($row['function']);
                                            $params = $mirror->getParameters();
                                        }

                                        foreach ($row['args'] as $key => $value) : @endphp
											<tr>
												<td><code>{{ esc(isset($params[$key]) ? '$' . $params[$key]->name : "#{$key}") }}</code></td>
												<td><pre>{{ esc(print_r($value, true)) }}</pre></td>
											</tr>
										@endforeach

										</table>
									</div>
								@else
									()
								{{ endif; }}
							{{ endif; }}

							@if (! isset($row['class']) && isset($row['function']))
								&nbsp;&nbsp;&mdash;&nbsp;&nbsp;	{{ $row['function'] }}()
							{{ endif; }}
						</p>

						<!-- Source? -->
						@if (isset($row['file']) && is_file($row['file']) && isset($row['class']))
							<div class="source">
								{{ static::highlightFile($row['file'], $row['line']) }}
							</div>
						{{ endif; }}
					</li>

				{{ endforeach; }}
				</ol>

			</div>

			<!-- Server -->
			<div class="content" id="server">
				@foreach (['_SERVER', '_SESSION'] as $var)
					@php
                    if (empty($GLOBALS[$var]) || ! is_array($GLOBALS[$var])) {
                        continue;
                    } @endphp

					<h3>${{ $var }}</h3>

					<table>
						<thead>
							<tr>
								<th>Key</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($GLOBALS[$var] as $key => $value)
							<tr>
								<td>{{ $key }}</td>
								<td>
									@if (is_string($value))
										{{ $value }}
									{{ else: }}
										<pre>{{ esc(print_r($value, true)) }}</pre>
									{{ endif; }}
								</td>
							</tr>
						{{ endforeach; }}
						</tbody>
					</table>

				@endforeach

				<!-- Constants -->
				@php $constants = get_defined_constants(true); @endphp
				@if (! empty($constants['user']))
					<h3>Constants</h3>

					<table>
						<thead>
							<tr>
								<th>Key</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($constants['user'] as $key => $value)
							<tr>
								<td>{{ $key }}</td>
								<td>
									@if (is_string($value))
										{{ $value }}
									{{ else: }}
										<pre>{{ esc(print_r($value, true)) }}</pre>
									{{ endif; }}
								</td>
							</tr>
						{{ endforeach; }}
						</tbody>
					</table>
				{{ endif; }}
			</div>

			<!-- Request -->
			<div class="content" id="request">
				@php $request = \Config\Services::request(); @endphp

				<table>
					<tbody>
						<tr>
							<td style="width: 10em">Path</td>
							<td>{{ $request->uri }}</td>
						</tr>
						<tr>
							<td>HTTP Method</td>
							<td>{{ esc($request->getMethod(true)) }}</td>
						</tr>
						<tr>
							<td>IP Address</td>
							<td>{{ esc($request->getIPAddress()) }}</td>
						</tr>
						<tr>
							<td style="width: 10em">Is AJAX Request?</td>
							<td>{{ $request->isAJAX() ? 'yes' : 'no' }}</td>
						</tr>
						<tr>
							<td>Is CLI Request?</td>
							<td>{{ $request->isCLI() ? 'yes' : 'no' }}</td>
						</tr>
						<tr>
							<td>Is Secure Request?</td>
							<td>{{ $request->isSecure() ? 'yes' : 'no' }}</td>
						</tr>
						<tr>
							<td>User Agent</td>
							<td>{{ esc($request->getUserAgent()->getAgentString()) }}</td>
						</tr>

					</tbody>
				</table>


				@php $empty = true; @endphp
				@foreach (['_GET', '_POST', '_COOKIE'] as $var)
					@php
                    if (empty($GLOBALS[$var]) || ! is_array($GLOBALS[$var])) {
                        continue;
                    } @endphp

					@php $empty = false; @endphp

					<h3>${{ $var }}</h3>

					<table style="width: 100%">
						<thead>
							<tr>
								<th>Key</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($GLOBALS[$var] as $key => $value)
							<tr>
								<td>{{ $key }}</td>
								<td>
									@if (is_string($value))
										{{ $value }}
									{{ else: }}
										<pre>{{ esc(print_r($value, true)) }}</pre>
									{{ endif; }}
								</td>
							</tr>
						{{ endforeach; }}
						</tbody>
					</table>

				@endforeach

				@if ($empty)

					<div class="alert">
						No $_GET, $_POST, or $_COOKIE Information to show.
					</div>

				{{ endif; }}

				@php $headers = $request->getHeaders(); @endphp
				@if (! empty($headers))

					<h3>Headers</h3>

					<table>
						<thead>
							<tr>
								<th>Header</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($headers as $value)
							@php
                            if (empty($value)) {
                                continue;
                            }

                            if (! is_array($value)) {
                                $value = [$value];
                            } @endphp
							@foreach ($value as $h)
								<tr>
									<td>{{ esc($h->getName(), 'html') }}</td>
									<td>{{ esc($h->getValueLine(), 'html') }}</td>
								</tr>
							{{ endforeach; }}
						{{ endforeach; }}
						</tbody>
					</table>

				{{ endif; }}
			</div>

			<!-- Response -->
			@php
                $response = \Config\Services::response();
                $response->setStatusCode(http_response_code());
            @endphp
			<div class="content" id="response">
				<table>
					<tr>
						<td style="width: 15em">Response Status</td>
						<td>{{ esc($response->getStatusCode() . ' - ' . $response->getReason()) }}</td>
					</tr>
				</table>

				@php $headers = $response->getHeaders(); @endphp
				@if (! empty($headers))
					{{ natsort($headers) }}

					<h3>Headers</h3>

					<table>
						<thead>
							<tr>
								<th>Header</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($headers as $name => $value)
							<tr>
								<td>{{ $name, 'html' }}</td>
								<td>{{ esc($response->getHeaderLine($name), 'html') }}</td>
							</tr>
						{{ endforeach; }}
						</tbody>
					</table>

				{{ endif; }}
			</div>

			<!-- Files -->
			<div class="content" id="files">
				@php $files = get_included_files(); @endphp

				<ol>
				@foreach ($files as $file)
					<li>{{ esc(static::cleanPath($file)) }}</li>
				@endforeach
				</ol>
			</div>

			<!-- Memory -->
			<div class="content" id="memory">

				<table>
					<tbody>
						<tr>
							<td>Memory Usage</td>
							<td>{{ esc(static::describeMemory(memory_get_usage(true))) }}</td>
						</tr>
						<tr>
							<td style="width: 12em">Peak Memory Usage:</td>
							<td>{{ esc(static::describeMemory(memory_get_peak_usage(true))) }}</td>
						</tr>
						<tr>
							<td>Memory Limit:</td>
							<td>{{ esc(ini_get('memory_limit')) }}</td>
						</tr>
					</tbody>
				</table>

			</div>

		</div>  <!-- /tab-content -->

	</div> <!-- /container -->

	<div class="footer">
		<div class="container">

			<p>
				Displayed at {{ esc(date('H:i:sa')) }} &mdash;
				PHP: {{ PHP_VERSION }}  &mdash;
				CodeIgniter: {{ \CodeIgniter\CodeIgniter::CI_VERSION }}
			</p>

		</div>
	</div>

</body>
</html>
