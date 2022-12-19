<?php

namespace OC\Share20;

use Closure;
use OCA\Files_Sharing\DefaultShareDisplayTemplateProvider;
use OCP\Server;
use OCP\Share\IShare;
use OCP\Share\IShareDisplayTemplateFactory;
use OCP\Share\IShareDisplayTemplateProvider;

class ShareDisplayTemplateFactory implements IShareDisplayTemplateFactory {
	/**
	 * @var list<array{class: class-string<IShareDisplayTemplateFactory>, condition: Closure(IShare): bool} $displayShareTemplateProviders
	 */
	private array $displayShareTemplateProviders = [];

	public function registerDisplayShareTemplate(string $shareDisplayTemplateClass, Closure $condition): void {
		$this->displayShareTemplateProviders[] = [
			'class' => $shareDisplayTemplateClass,
			'condition' => $condition,
		];
	}

	public function getTemplate(IShare $share): IShareDisplayTemplateProvider {
		foreach ($this->displayShareTemplateProviders as $provider) {
			if ($provider['condition']($share)) {
				return Server::get($provider['class']);
			}
		}
		return Server::get(DefaultShareDisplayTemplateProvider::class);
	}
}
