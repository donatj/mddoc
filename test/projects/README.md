# Documentation projects

Each directory is a small PHP project.

Each project includes its source files, `mddoc.xml`, and the generated `README.md`.
`DocumentationProjectTest` runs MDDoc with `--dry-run=true` for every project.

Add a project when a change needs a full documentation example. Keep each project focused. Use ordinary project paths in the configuration file.

To update an expected document, run this from the repository root:

```
cd test/projects/project-name
../../../composer/bin/mddoc mddoc.xml
```
