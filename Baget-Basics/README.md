
# Baget
--------------------

### Setup BaGet server with docker
In this project directory run
```bash
docker run --rm --name baget -p 5555:5000 --env-file baget.env -v "$(pwd)/baget-data:/var/baget" loicsharma/baget:latest
```

### Create .Net App
```bash
dotnet new console -o App -n DotNet.Docker
```

### Install a package
```bash
nuget install Newtonsoft.Json -OutputDirectory packages
```

### Push package to local BaGet server
```bash
dotnet nuget push -k NUGET-SERVER-API-KEY -s http://localhost:5555/v3/index.json packages/Newtonsoft.Json.13.0.1/Newtonsoft.Json.13.0.1.nupkg
```

### Delete packages folder
```bash
rm -rf packages
```

### Add your BaGet server as source
```bash
nuget sources Add -Name "MyServer" -Source -ConfigFile nuget.config
```

### Install the package, now from your BaGet server
```bash
nuget install Newtonsoft.Json -OutputDirectory packages -ConfigFile nuget.config
```

### List packages (doesn't works with baget)
```bash
nuget list -ConfigFile nuget.config
```

### Delete packages
```bash
nuget delete Newtonsoft.Json 13.0.1 -Source http://localhost:5555 -apikey NUGET-SERVER-API-KEY
```

## References:

[Containerize an app with Docker tutorial - .NET | Microsoft Docs](https://docs.microsoft.com/en-us/dotnet/core/docker/build-container?tabs=linux)

[Installing NuGet client tools | Microsoft Docs](https://docs.microsoft.com/en-us/nuget/install-nuget-client-tools)

[loic-sharma/BaGet: A lightweight NuGet and symbol server](https://github.com/loic-sharma/BaGet)

[Baget installation with docker](https://loic-sharma.github.io/BaGet/installation/docker/)