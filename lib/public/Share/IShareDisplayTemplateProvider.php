<?php

namespace OCP\Share;

use OCP\AppFramework\Http\TemplateResponse;

interface IShareDisplayTemplateProvider {
	public function renderPage(IShare $share, string $token, string $path): TemplateResponse;
}
