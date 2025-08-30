.PHONY: gen-test-hosts gen-test-cfg run-test test

gen-test-hosts:
	@echo "localhost" > ansible.hosts

gen-test-cfg:
	@printf "[defaults]\nroles_path=../" > ansible.cfg

run-test:
	@ansible-playbook tests/playbook.yml -i ansible.hosts -v

test: gen-test-hosts gen-test-cfg run-test
