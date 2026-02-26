Prompt engineering is a relatively new discipline for developing and optimizing prompts to efficiently use language models (LMs) for a wide variety of applications and research topics. Prompt engineering skills help to better understand the capabilities and limitations of large language models (LLMs).
[[بررسی کامل کلاس PlatformDatabaseSyncer]]
Researchers use prompt engineering to improve the capacity of LLMs on a wide range of common and complex tasks such as question answering and arithmetic reasoning. Developers use prompt engineering to design robust and effective prompting techniques that interface with LLMs and other tools.

Prompt engineering is not just about designing and developing prompts. It encompasses a wide range of skills and techniques that are useful for interacting and developing with LLMs. It's an important skill to interface, build with, and understand capabilities of LLMs. You can use prompt engineering to improve safety of LLMs and build new capabilities like augmenting LLMs with domain knowledge and external tools.

Motivated by the high interest in developing with LLMs, we have created this new prompt engineering guide that contains all the latest papers, advanced prompting techniques, learning guides, model-specific prompting guides, lectures, references, new LLM capabilities, and tools related to prompt engineering.

# Introduction

Prompt engineering is a relatively new discipline for developing and optimizing prompts to efficiently apply and build with large language models (LLMs) for a wide variety of applications and use cases.

Prompt engineering skills help to better understand the capabilities and limitations of LLMs. Researchers use prompt engineering to improve safety and the capacity of LLMs on a wide range of common and complex tasks such as question answering and arithmetic reasoning. Developers use prompt engineering to design robust and effective prompting techniques that interface with LLMs and other tools.

This comprehensive guide covers the theory and practical aspects of prompt engineering and how to leverage the best prompting techniques to interact and build with LLMs.

> [!INFO] Note on Examples
> All examples are tested with `gpt-3.5-turbo` using the [OpenAI's Playground](https://platform.openai.com/playground) unless otherwise specified.
> The model uses the default configurations, i.e., `temperature=1` and `top_p=1`.
> The prompts should also work with other models that have similar capabilities as `gpt-3.5-turbo` but the model responses may vary.

[LLM Settings](https://www.promptingguide.ai/introduction/settings) | [Basics of Prompting](https://www.promptingguide.ai/introduction/basics) | [Prompt Elements](https://www.promptingguide.ai/introduction/elements) | [General Tips for Designing Prompts](https://www.promptingguide.ai/introduction/tips) | [Examples of Prompts](https://www.promptingguide.ai/introduction/examples)

---

# LLM Settings

### [Youtube video](https://youtu.be/CB0H7esOl68)

> [!QUOTE]- **Video Transcript**
> Hi everyone, in this video I want to talk about LLM settings. So the idea of this section in our prompting guide is to tell you a little bit about how to use these LLM settings. So when you're exploring and experimenting and prompting these models, there are a couple of settings that you can tune to get the desirable results that you want.
>
> Now, if you are coming from the world of ChatGPT, right, if you use ChatGPT the conversational chatbot from OpenAI, you may not know that these models are actually using some specific fixed settings. You don't see them, you cannot really tweak those, you cannot configure them. But if you come from the world of APIs, you do have access to certain settings that you can configure and you can adjust to get the results that you want. So this is very popular among developers. So this only applies to you if you're using some type of LLM APIs, right? This could be any provider, it could be OpenAI or any of these other LLM providers.
>
> So what I want to do in this video is to go through a few of these settings and explain to you with some examples how you can leverage these settings. There are a couple of settings that do stand out here when using large language models via APIs. If you go to the playground, you pretty much have an idea on what are these important settings. So you have them right here, for instance, in the OpenAI playground, you have what's called temperature, maximum length, stop sequences, frequency penalty, presence penalty. And what we have done in our guide is basically provide you some explanations as to what these are.
>
> Now in this video, what I want to do is I want to kind of quickly go over these ideas and try to explain to you how you can leverage them when you're developing with these models. I must say that we often don't really talk about temperature or Top P or you know, most of these settings, but they're actually quite important and useful. But it really depends on what you're aiming to achieve. So let's go through some of these.

### Description

When designing and testing prompts, you typically interact with the LLM via an API. You can configure a few parameters to get different results for your prompts. Tweaking these settings are important to improve reliability and desirability of responses and it takes a bit of experimentation to figure out the proper settings for your use cases. Below are the common settings you will come across when using different LLM providers:

- **Temperature**: In short, the lower the `temperature`, the more deterministic the results in the sense that the highest probable next token is always picked. Increasing temperature could lead to more randomness, which encourages more diverse or creative outputs. You are essentially increasing the weights of the other possible tokens. In terms of application, you might want to use a lower temperature value for tasks like fact-based QA to encourage more factual and concise responses. For poem generation or other creative tasks, it might be beneficial to increase the temperature value.

- **Top P**: A sampling technique with temperature, called nucleus sampling, where you can control how deterministic the model is. If you are looking for exact and factual answers keep this low. If you are looking for more diverse responses, increase to a higher value. If you use Top P it means that only the tokens comprising the `top_p` probability mass are considered for responses, so a low `top_p` value selects the most confident responses. This means that a high `top_p` value will enable the model to look at more possible words, including less likely ones, leading to more diverse outputs.

> [!TIP] Recommendation
> The general recommendation is to alter temperature or Top P but not both.

- **Max Length**: You can manage the number of tokens the model generates by adjusting the `max length`. Specifying a max length helps you prevent long or irrelevant responses and control costs.

- **Stop Sequences**: A `stop sequence` is a string that stops the model from generating tokens. Specifying stop sequences is another way to control the length and structure of the model's response. For example, you can tell the model to generate lists that have no more than 10 items by adding "11" as a stop sequence.

- **Frequency Penalty**: The `frequency penalty` applies a penalty on the next token proportional to how many times that token already appeared in the response and prompt. The higher the frequency penalty, the less likely a word will appear again. This setting reduces the repetition of words in the model's response by giving tokens that appear more a higher penalty.

- **Presence Penalty**: The `presence penalty` also applies a penalty on repeated tokens but, unlike the frequency penalty, the penalty is the same for all repeated tokens. A token that appears twice and a token that appears 10 times are penalized the same. This setting prevents the model from repeating phrases too often in its response. If you want the model to generate diverse or creative text, you might want to use a higher presence penalty. Or, if you need the model to stay focused, try using a lower presence penalty.

> [!TIP] Recommendation
> Similar to `temperature` and `top_p`, the general recommendation is to alter the frequency or presence penalty but not both.

Before starting with some basic examples, keep in mind that your results may vary depending on the version of LLM you use.

---

# Basics of Prompting

## [Prompting an LLM](https://www.promptingguide.ai/introduction/basics#prompting-an-llm)

You can achieve a lot with simple prompts, but the quality of results depends on how much information you provide it and how well-crafted the prompt is. A prompt can contain information like the _instruction_ or _question_ you are passing to the model and include other details such as _context_, _inputs_, or _examples_. You can use these elements to instruct the model more effectively to improve the quality of results.

Let's get started by going over a basic example of a simple prompt:

**Prompt**
```text
The sky is
```

**Output:**
```text
blue.
```

If you are using the OpenAI Playground or any other LLM playground, you can prompt the model as shown in the following screenshot:

> [!NOTE] Role-based Prompting
> Something to note is that when using the OpenAI chat models like `gpt-3.5-turbo` or `gpt-4`, you can structure your prompt using three different roles: `system`, `user`, and `assistant`.
> - The **system** message is not required but helps to set the overall behavior of the assistant.
> - The **user** message is used to directly prompt the model.
> - The **assistant** message corresponds to the model response or can be used to pass examples of desired behavior.
>
> For simplicity, all of the examples, except when it's explicitly mentioned, will use only the `user` message to prompt the `gpt-3.5-turbo` model. You can learn more about working with chat models [here](https://www.promptingguide.ai/models/chatgpt).

You can observe from the prompt example above that the language model responds with a sequence of tokens that make sense given the context `"The sky is"`. The output might be unexpected or far from the task you want to accomplish. In fact, this basic example highlights the necessity to provide more context or instructions on what specifically you want to achieve with the system. This is what prompt engineering is all about.

Let's try to improve it a bit:

**Prompt:**
```text
Complete the sentence: The sky is
```

**Output:**
```text
blue during the day and dark at night.
```

Is that better? Well, with the prompt above you are instructing the model to complete the sentence so the result looks a lot better as it follows exactly what you told it to do ("complete the sentence"). This approach of designing effective prompts to instruct the model to perform a desired task is what's referred to as **prompt engineering** in this guide.

The example above is a basic illustration of what's possible with LLMs today. Today's LLMs are able to perform all kinds of advanced tasks that range from text summarization to mathematical reasoning to code generation.

## [Prompt Formatting](https://www.promptingguide.ai/introduction/basics#prompt-formatting)

You have tried a very simple prompt above. A standard prompt has the following format:

```text
<Question>?
```

or

```text
<Instruction>
```

You can format this into a question answering (QA) format, which is standard in a lot of QA datasets, as follows:

```text
Q: <Question>?
A:
```

When prompting like the above, it's also referred to as _zero-shot prompting_, i.e., you are directly prompting the model for a response without any examples or demonstrations about the task you want it to achieve. Some large language models have the ability to perform zero-shot prompting but it depends on the complexity and knowledge of the task at hand and the tasks the model was trained to perform good on.

A concrete prompt example is as follows:

**Prompt**
```text
Q: What is prompt engineering?
```

With some of the more recent models you can skip the "Q:" part as it is implied and understood by the model as a question answering task based on how the sequence is composed. In other words, the prompt could be simplified as follows:

**Prompt**
```text
What is prompt engineering?
```

Given the standard format above, one popular and effective technique to prompting is referred to as _few-shot prompting_ where you provide exemplars (i.e., demonstrations). You can format few-shot prompts as follows:

```text
<Question>?
<Answer>
<Question>?
<Answer>
<Question>?
<Answer>
<Question>?
```

The QA format version would look like this:

```text
Q: <Question>?
A: <Answer>
Q: <Question>?
A: <Answer>
Q: <Question>?
A: <Answer>
Q: <Question>?
A:
```

Keep in mind that it's not required to use the QA format. The prompt format depends on the task at hand. For instance, you can perform a simple classification task and give exemplars that demonstrate the task as follows:

**Prompt:**
```text
This is awesome! // Positive
This is bad! // Negative
Wow that movie was rad! // Positive
What a horrible show! //
```

**Output:**
```text
Negative
```

Few-shot prompts enable in-context learning, which is the ability of language models to learn tasks given a few demonstrations. We discuss zero-shot prompting and few-shot prompting more extensively in upcoming sections.

## [Youtube Video](https://youtu.be/iwYtzPJELkk)

> [!QUOTE]- **Video Transcript**
> Hi everyone, so I am doing this recording because I wanted to show you how to use the OpenAI playground. So if you have come to the prompt engineering guide, this guide is about learning how to prompt these large language models. And in our guide we try our best to show you with different examples and different approaches how to prompt these models for various use cases. But at the beginning what we want to do is we want to show you like basic first steps on how to prompt these models and for that you really need to use a playground.
>
> So different language model providers provide different playgrounds for their models. One of the models that we use here in the prompt engineering guide is the OpenAI playground, but you can use any other playground. So what we want to show you is how you can use the playground to follow through the examples that we provide in our prompt engineering guide.
>
> So for that you need to have your playground set up. So in order for you to have the OpenAI playground set up, what you need to do is you need to visit platform.openai.com and you need to create an account with OpenAI. And once you have created that account, you will see that you're signed in. When you go to the platform.openai.com what you see here is documentation by default but what we want to do is we want to go to the actual playground. So we go to playground, we click on that and here what you see is we see a nice interface where we can interact with different models.
>
> If we go back to our guide you will see that the standard or the default model that we are experimenting on is GPT-3.5-turbo. You can experiment with newer models, so there are different variants of GPT-3.5-turbo and there is even GPT-4 as well which is the newer model. But so far by default we are using this right for all of our examples unless we explicitly say that we are using a different model.
>
> Also notice that we have these values here. I'll talk about this in another video but for now for this video what I want to do is just keep it in the scope of starting the playground and start to play around with it with some of the examples that we provide in our guide. So we are at the playground and just a quick intro of the playground. So what we see here is this playground has different settings. There is this panel here which is a system panel which is basically a system role. We also have user role and in addition to that we have also assistant role. So we have three different types of roles that allow us to interact with these language models in different ways.
>
> Also note that I am using here the chat interface. There are different playgrounds here: there's assistance, there's compare, there's completions as well which I think will get deprecated at some point, but for now we're using the chat playground. And it looks something like this.
>
> So just to take an example here of a very simple example of how you would use the playground to test out the different prompts that we are providing in our guide. I'll show you very quickly here. So if you go to the left hand side here of the guide we have different... um under introduction we have basics of prompting. So if you go to basics of prompting, we see there's a basic prompt. So what I'll do is I'll just kind of copy... I'll use this copy button here, I'll copy that and then I'll bring it over to the system prompt... sorry the system role... and then I'll just prompt them all this way. So once I have it like this, then I can just... I won't change anything, everything is again temperature is default one, top_p default one. We will talk about that later on in another video but for now what we're going to do is just we want to test this out.
>
> And I can see that it's already producing or generating text. So this is a generative model, it is a text model that generates text based on the prompt and it's basically continuing the text "the sky is". Now there are different ways how you can prompt these models because we have different roles... we have system role, user role, and assistant role. We can leverage the models in different ways.
>
> So what I'll show you here is another way how you can go about interacting with these chat models. So I'll remove my prompt from system role and then I'll bring it over add a user role then I'll paste my prompt here and then I'll submit it. And you can see that it gave me also a continuation of my prompt "the sky is" and this continuation is a lot shorter.
>
> And that's something to note here. When we use this prompt, you know while we can do it right with the user role and leave the system role empty, we can't do that... um you will see that the outputs are very different. So you can see that here we use the user role "the sky is" and the assistant responded with "clear and blue with fluffy white clouds scattered across it". It's very different from this what the other example that I showed you that uses the system role is producing. It's a different output. So that's something to note with these models that they're non-deterministic, they'll give you different outputs even though you're using the same prompt. But also because we're using the user role it gave us something different, it's shorter than the previous one when we use system role.
>
> So that's something to note. There's nothing that says that you shouldn't leverage models this way or leverage the system role. The system role is really a useful feature if you are building out an assistant and you want to enforce some type of behavior, you want to enforce some type of logic in the way the model is responding to you, that's what you will use the system role for. But because this was a very basic prompt you know I just use the user role and it is totally valid to use it this way. So it's a bit flexible in the way we're using the model.
>
> So I think I will leave it at that. And for all the examples you can pretty much do the same. So if you go through the guide now you know you can take something like this and you can either use the system role or you can also use the user role here. So you can do something like this and then you can say um again "complete the sentence the sky is blue on a clear day" because we were a little bit more specific here you can see that the assistant response was a lot shorter because now it's a sentence. So this is the very neat part of working with these models that the more specific you are the better results are going to be. So that's a quick introduction into the playground.

---

# Elements of a Prompt

As we cover more and more examples and applications with prompt engineering, you will notice that certain elements make up a prompt.

A prompt contains any of the following elements:

- **Instruction**: a specific task or instruction you want the model to perform
- **Context**: external information or additional context that can steer the model to better responses
- **Input Data**: the input or question that we are interested to find a response for
- **Output Indicator**: the type or format of the output.

To demonstrate the prompt elements better, here is a simple prompt that aims to perform a text classification task:

**Prompt**
```text
Classify the text into neutral, negative, or positive
Text: I think the food was okay.
Sentiment:
```

In the prompt example above, the instruction correspond to the classification task, "Classify the text into neutral, negative, or positive". The input data corresponds to the "I think the food was okay." part, and the output indicator used is "Sentiment:". Note that this basic example doesn't use context but this can also be provided as part of the prompt. For instance, the context for this text classification prompt can be additional examples provided as part of the prompt to help the model better understand the task and steer the type of outputs that you expect.

You do not need all the four elements for a prompt and the format depends on the task at hand. We will touch on more concrete examples in upcoming guides.

## [Youtube video](https://youtu.be/kgBZhJnh-vk)

> [!QUOTE]- **Video Transcript**
> Hi everyone, in this video I want to talk a little bit about elements of a prompt. When designing your prompts and building out your use cases with large language models, you have to think a lot about your prompts and the way you're designing them to get the most or the best results from these language models. And for that you have to think about its design right, so you have to think a little bit about the prompt design itself.
>
> Typically a prompt is composed of the following: so they typically include an instruction. We will talk a little bit about what instruction means in a bit. It also consists of a context, but context really depends on the use case. So in this case in the example I'm providing here on the right hand side which is a basic text classification, you can think of it like sentiment analysis where we're just classifying you know an input text. It doesn't really require context or it doesn't use any context. We're not providing like for instance demonstrations or anything like that. It's just we are doing it in a very simple way where we're not providing extra context to the model, we just expect the model to be able to perform this task. Later down the road we're going to talk about zero shot prompting and how language models are able to do this in a later video.
>
> But talking about the elements of a prompt, input data is also really important to highlight here. How you pass the input to the model really depends on the use case. So in this case because I am classifying a piece of text it makes sense to use something like text as an indicator but I could also be very specific for the model which also helps the model a bit. It steers the model to get the right behavior from it right. So I can say something like u a tweet or whatever type of input this is. But I kept it very generic in the example here so I just say text and then I think the food was okay. It's really the input data here that we're passing to the model so that the model can classify.
>
> Now the last bit here which is output indicator. I'm using output indicator as sentiment as an example. Now I'm being very specific to the model about what is the output that I'm expecting so it makes sense to use something like sentiment. But if we are talking in generic terms we could also use output as an indicator itself right. And most of these models are intelligent enough to understand what it means when you say output, they will try to perform the task based on the instruction or the original instruction you gave it.
>
> So that is a summary of the elements of a prompt. And what I'll do now is I'll going to show you how you would design this in something like the OpenAI playground. But before I do that I want to go back here to our prompting guide and here is where you find a little bit on more about the elements of a prompt and the different definitions for each element right. So we have the instruction, context, input data and output indicator. And we also have the example that I'm using here which you can directly you know copy paste into the playground as we did in the previous guide and tutorial that we showed in the previous um section.
>
> So what I'm going to do is I'm just going to copy this and I'm going to paste it right into the system panel. So as we said in the previous guide the system panel or the system role is where you will Define what type of behavior you are expecting from this model. In this case I'm using GPT-3.5-turbo as my model so I can just paste it like this and I can submit this as is. So I'll just submit and you can see here that the model outputted neutral so it understood the task and gave me neutral. Seems like neutral is the right label for this one, it is a little bit subjective but I must say for this task but I think that's correct and that's the expected output that I expected from this model.
>
> I didn't change anything here in the playground again I'm using the same default settings. Now there is a different way how you can think about the prompt design and leveraging the different roles available in the playground. Also understand that a lot of these playgrounds are making use of this standardized way of prompting these models using these different roles like the system role, assistant role and also the user role. So I want to show you a different version of how you can do this particular task without using the system role or using system role in combination with the user role.
>
> So one way you can do this and you can easily try here is you can essentially take this and then you can use this right as on user role you can just add the input here right and then I can just remove that. So I pretty much simplified The Prompt design here and let's see what the model outputs. Right you can see that the model outputted the same output that we are expecting and I did a couple of things here right. I simplified the prompt by separating the different components or elements into the different roles. And the reason I did this is because I do know that those roles are used in that way for the model right. The model was trained with a lot of data that looks very similar to how I am inputting the particular you know task with the description here in the system role and the actual input which goes in the user role and the assistant role is obviously just the output of the model right.
>
> And I got rid of all the different indicators so the output indicator which is sentiment in this case I didn't need to use that and I also got rid of the text which is the input indicator that I was using. I also completely got rid of that so I'm not using for instance I'm not using this anymore right. So you can use the roles to simplify the task and kind of Leverage this interface that's now very standardized in the world of large language models to get more reliable outputs out of these models for any task that you're interested in building.
>
> So that's a little bit about the elements of a prompt, an example as well in the playground so you can start to play around exactly with it and you can try different outputs you can try different inputs right to see what you get as output. You can try like positive text or negative text um to see what you get. Now there are more advanced ways on how we can use these different roles the system role to keep improving the reliability of this model. This is a very simple example but you know in a robust system where you're trying to put something like this into production like a sentiment classifier you would have to experiment and evaluate how these models are performing on this task and you would need like you need a a bunch of examples to actually evaluate properly right. But this is just a simple example just to show you and demonstrate the different elements of a prompt and why it's important to think about that when you're designing and optimizing your prompts.
>
> We'll talk a little bit more about know tactics to use those roles better in a future video so please subscribe if you want to learn more about that. And also we'll talk a little bit about the different indicators as well right so how do we pass how do we pass optimally inputs and how do we declare our outputs as well how do we specify outputs to get reliable outputs right. Sometimes we may want to structure the output in a way maybe we want it in kind of a JSON object or some type of object or output format so all of that is a conversation we will have in future videos. But for now it's really important to think about different elements because this is what each one of the prompts that you will be designing and optimizing will carry a combination of these different components.
>
> Now something I didn't mention is while I was demonstrating this particular figure here um you know there like context is not really required right. So instruction is sort of a requirement because you need to instruct the model and it's good to be specific about the instruction that you want the model to carry out. The input data it really depends on the task as well because you could be asking the model generate me an email of using this particular tone and so on and that doesn't really requires input data right. It's you're just asking the model to be creative and to kind of generate or produce a new email that you might be interested in. So all of these different components right you can combine them but it really depends on the task that you're working on.
>
> And again output indicator as well it really depends on the task right. In the email generation example we didn't use an open indicator but you may be interested for instance to generate an email that has a specific structure like say has like a body or you want to output it in a different format or something like that then in that case you probably can design some type of uh in extra instruction or indicator specifying the particular output that you want from the model so you can steer the model better.
>
> So I'll leave it at that for this video hopefully you've got an idea of what are the important components of a prompt so that you can continue to developing your use cases and start to think more deeply about how to design these prompts to reliably use these models.
>
> So I'll catch you in the next one by.

---

# General Tips for Designing Prompts

Here are some tips to keep in mind while you are designing your prompts:

### [Start Simple](https://www.promptingguide.ai/introduction/tips#start-simple)

As you get started with designing prompts, you should keep in mind that it is really an iterative process that requires a lot of experimentation to get optimal results. Using a simple playground from OpenAI or Cohere is a good starting point.

You can start with simple prompts and keep adding more elements and context as you aim for better results. Iterating your prompt along the way is vital for this reason. As you read the guide, you will see many examples where specificity, simplicity, and conciseness will often give you better results.

When you have a big task that involves many different subtasks, you can try to break down the task into simpler subtasks and keep building up as you get better results. This avoids adding too much complexity to the prompt design process at the beginning.

### [The Instruction](https://www.promptingguide.ai/introduction/tips#the-instruction)

You can design effective prompts for various simple tasks by using commands to instruct the model what you want to achieve, such as "Write", "Classify", "Summarize", "Translate", "Order", etc.

Keep in mind that you also need to experiment a lot to see what works best. Try different instructions with different keywords, contexts, and data and see what works best for your particular use case and task. Usually, the more specific and relevant the context is to the task you are trying to perform, the better. We will touch on the importance of sampling and adding more context in the upcoming guides.

Others recommend that you place instructions at the beginning of the prompt. Another recommendation is to use some clear separator like "###" to separate the instruction and context.

For instance:

**Prompt:**
```text
### Instruction ###
Translate the text below to Spanish:
Text: "hello!"
```

**Output:**
```text
¡Hola!
```

### [Specificity](https://www.promptingguide.ai/introduction/tips#specificity)

Be very specific about the instruction and task you want the model to perform. The more descriptive and detailed the prompt is, the better the results. This is particularly important when you have a desired outcome or style of generation you are seeking. There aren't specific tokens or keywords that lead to better results. It's more important to have a good format and descriptive prompt. In fact, providing examples in the prompt is very effective to get desired output in specific formats.

When designing prompts, you should also keep in mind the length of the prompt as there are limitations regarding how long the prompt can be. Thinking about how specific and detailed you should be. Including too many unnecessary details is not necessarily a good approach. The details should be relevant and contribute to the task at hand. This is something you will need to experiment with a lot. We encourage a lot of experimentation and iteration to optimize prompts for your applications.

As an example, let's try a simple prompt to extract specific information from a piece of text.

**Prompt:**
```text
Extract the name of places in the following text.
Desired format:
Place: <comma_separated_list_of_places>
Input: "Although these developments are encouraging to researchers, much is still a mystery. “We often have a black box between the brain and the effect we see in the periphery,” says Henrique Veiga-Fernandes, a neuroimmunologist at the Champalimaud Centre for the Unknown in Lisbon. “If we want to use it in the therapeutic context, we actually need to understand the mechanism.“"
```

**Output:**
```text
Place: Champalimaud Centre for the Unknown, Lisbon
```

Input text is obtained from [this Nature article](https://www.nature.com/articles/d41586-023-00509-z).

### [Avoid Impreciseness](https://www.promptingguide.ai/introduction/tips#avoid-impreciseness)

Given the tips above about being detailed and improving format, it's easy to fall into the trap of wanting to be too clever about prompts and potentially creating imprecise descriptions. It's often better to be specific and direct. The analogy here is very similar to effective communication -- the more direct, the more effective the message gets across.

For example, you might be interested in learning the concept of prompt engineering. You might try something like:

```text
Explain the concept prompt engineering. Keep the explanation short, only a few sentences, and don't be too descriptive.
```

It's not clear from the prompt above how many sentences to use and what style. You might still somewhat get good responses with the above prompts but the better prompt would be one that is very specific, concise, and to the point. Something like:

```text
Use 2-3 sentences to explain the concept of prompt engineering to a high school student.
```

### [To do or not to do?](https://www.promptingguide.ai/introduction/tips#to-do-or-not-to-do)

Another common tip when designing prompts is to avoid saying what not to do but say what to do instead. This encourages more specificity and focuses on the details that lead to good responses from the model.

Here is an example of a movie recommendation chatbot failing at exactly what I don't want it to do because of how I wrote the instruction -- focusing on what not to do.

**Prompt:**
```text
The following is an agent that recommends movies to a customer. DO NOT ASK FOR INTERESTS. DO NOT ASK FOR PERSONAL INFORMATION.
Customer: Please recommend a movie based on my interests.
Agent:
```

**Output:**
```text
Sure, I can recommend a movie based on your interests. What kind of movie would you like to watch? Do you prefer action, comedy, romance, or something else?
```

Here is a better prompt:

**Prompt:**
```text
The following is an agent that recommends movies to a customer. The agent is responsible to recommend a movie from the top global trending movies. It should refrain from asking users for their preferences and avoid asking for personal information. If the agent doesn't have a movie to recommend, it should respond "Sorry, couldn't find a movie to recommend today.".
Customer: Please recommend a movie based on my interests.
Agent:
```

**Output:**
```text
Sorry, I don't have any information about your interests. However, here's a list of the top global trending movies right now: [list of movies]. I hope you find something you like!
```

Some of the examples above were adopted from the ["Best practices for prompt engineering with OpenAI API" article.](https://help.openai.com/en/articles/6654000-best-practices-for-prompt-engineering-with-openai-api)

## [Youtube video](https://youtu.be/7M6CSCIMJ3k)

> [!QUOTE]- **Video Transcript**
> Hi everyone, in this video I want to talk a little bit about some general tips for designing prompts. So I've been designing and optimizing some prompts for various use cases for a variety of clients from different domains ranging from health providers all the way to companies building HR solutions. And what I want to share here is a few tips and things to keep in mind as you design your prompt.
>
> We know that the process of designing prompts is very iterative in nature. So when you're designing a prompt for a language model you need to start very simple. One error and mistake that I see a lot of developers and users make is they get pretty clever and they want to ask the model to do a variety of things and they prompt the model, they don't get the results, they give up, they get discouraged based on what the language models are producing. And the reason for that is that that's not the right framework or the right strategy to design good prompts.
>
> The right way to do this is really to start simple, right. Start with a very basic task. Also if you have a very complex task it might help to break down the task into separate subtasks because it could be the case that the model you know it's not capable enough to handle all the instructions that you're giving the model to perform. So that's why it's really important to always start really simple, right. To get the model to do something really well and optimize the model to perform that task. And it's important to keep the instructions, keep the prompt really simple.
>
> The next step here is really the instruction. So we spoke about the prompt elements and one thing we mentioned there is that we need to specify instruction, right. What do we want the model to perform? What is the task the model needs to perform whether it's a classification task, summarization, translation? So it's important to think about what exactly this model is going to achieve and to use the right verbs or the right words to describe that task, right. So it's important to identify that when you're working on your use cases.
>
> So let's say we were to create some type of translation system. Um here is an example here at the bottom. Let's say we wanted to build some kind of translation system that converts text into Spanish right, so English text to Spanish. To do that it's you know you just instruct the model "translate the text below to Spanish" and then you pass in the text. We're using text as the input indicator and the input is going to be "hello". And once we pass it to the model, the model is going to understand okay this is a translation task because I'm using the keyword here is translate. The more clear and the more specific you know the wording for that instruction is the better results you're going to get right. So try to avoid ambiguous language try to avoid you know using words that the model might not know of right. So the simpler the words are the more specific are the better the results are going to be.
>
> Okay and we can try this actually. Um so for this prompt we don't really need instruction you can add the instruction part but you will see here that with modern interfaces like the one provided by the OpenAI playground we can basically just write the task that we want to perform and then we can take for instance we can take this... uh in fact I'll just leave it as is and then I'll show you another version that uses the user role. So you can see that we got "Hola" right so we got the right translation here. Now I can also do something like this and this is something I showed in a previous tutorial so I can take this remove this and then I can use the user role to provide my input that I want to translate to Spanish and then I can submit this right. And we got "Hola" here so so we got the right translation. That's how you would think about the instruction right. Try to make the instruction as clear and concise as possible.
>
> Now there's also a lot of recommendations you know if you go online lot of conversations about how to design prompts and one of the main tips that come up is specificity. Really be very specific about what you want right. So for some use cases you want for instance you want a specific format you want a specific tone. It's important to think about what exactly do you want from this model right. The model cannot really guess it. The model has an understanding of what it was trained on but in order for you to get the performance or get the results that you want or a specific output that you want you need to be as specific as possible.
>
> So I have an example here actually what I'll do is I'll just take this here again here and I'll show you how you can play around with this in the playground. So I have here "extract the name of places in the following text". Now the desired format I need to change this a bit. I could keep it the way it was but I just want to make it more clear. Um and then we have a "Place" right and I say here I want the comma separate the list of places that are provided in input. I'm using input here as input indicator but you know I could also take this and put it right here um as part of a as part of user but I'll just keep it like this. And then you can try the other version that I was testing so you can see here that the place was and it actually kept the indicator which is good. You know you could tell the model further that maybe you don't want this indicator as part of the output. That's something you can be more specific about and can instruct the model to Output however you want the output. And so we can see we can confirm that this is the right information that we were expecting from this particular Place extractor system.
>
> The other tip here is to avoid impreciseness and this has to do with specificity as well. And the reason for that is because you want to again as I mentioned earlier you want to avoid ambiguous language right because you're all you're doing is you are confusing the models. So the message has to be clear, the message has to be direct. Whatever instruction you're passing to the model has to be as direct and that's how you're going to get the best results from a system.
>
> So I have some example here: "explain the concept from engineering keep the explanation short only a few sentences don't be too descriptive". Um we're telling the model to do a lot of things here and we're not being too precise right. This is about being imprecise because you're not telling it how many sentences you want. You say short but what do you mean by short? You say don't be too descriptive what do we even mean by that? So we want to make it a lot simpler for the model to perform a task to get the desired results right. So we want some level of customization in the output that we're getting and so we need to be as precise as possible.
>
> So here is a better example compared to the one above: "use two to three sentences to explain the concept of prompt engineering to a high school student". Now I think this is a bit more clear because the target would be high school students right and I'm using things like two to three sentences to explain the concept right. I could even go a little bit more detailed but I think this is good enough as a first iteration that improves the preciseness of the prompt itself right. The instruction here is a lot more precise.
>
> So here this tip here is actually interesting. These models are trained to do right, they're trained to do and to perform tasks to perform instructions that users are giving it. So when you use language like "do not ask for interest" or anything like that it's like you're communicating to human. But in reality these models might not be trained effectively to perform tasks where they're told not to do specific things. So you want to avoid language like that. What would work instead is to better guide the model or better steer the model be more precise and just follow the above tips that I shared.
>
> So something like this can be converted to something like this instead um where you're being a little bit more specific right. You're telling them all what exactly you want to behavior to be and you kind of explain the logic without using language like "do not" right. Just do not use that "do not" language with the models because they tend to fail or they tend to the models tend to kind of derail and give you really bad output that you may not desire. And the models are getting a lot better right so some modern models might be able to deal with these particular instructions a lot better but I would say this is unnecessary right. You don't really need to tell the model "do not ask for personal information" as shown in this example. I think it's better if you tell the model specifically what you want in the behavior right instead of telling it what to avoid. So the more specific you are about what the model should perform or the task it should perform because it was trained to perform task it makes sense to be more positive in and be more direct and precise in what you want from the model.
>
> Okay so those are kind of some best practices. There's also a link here that you can click on and it will take you to the OpenAI official documentation where they have a little bit more on some further tips. There are you know other tips that I might be missing here but we continue to update the guide and provide better tips for all our developers and people that are using these large language models. So that will be it for this video hopefully it was useful and hopefully you can work on those examples and you can consider this when you're designing your prompts so that they can help you efficiently and effectively build your use cases with large language models. So I'll catch you in the next one, bye.

---

# Examples of Prompts

The previous section introduced a basic example of how to prompt LLMs.

This section will provide more examples of how to use prompts to achieve different tasks and introduce key concepts along the way. Often, the best way to learn concepts is by going through examples. The few examples below illustrate how you can use well-crafted prompts to perform different types of tasks.

**Topics:**

- [Text Summarization](https://www.promptingguide.ai/introduction/examples#text-summarization)
- [Information Extraction](https://www.promptingguide.ai/introduction/examples#information-extraction)
- [Question Answering](https://www.promptingguide.ai/introduction/examples#question-answering)
- [Text Classification](https://www.promptingguide.ai/introduction/examples#text-classification)
- [Conversation](https://www.promptingguide.ai/introduction/examples#conversation)
- [Code Generation](https://www.promptingguide.ai/introduction/examples#code-generation)
- [Reasoning](https://www.promptingguide.ai/introduction/examples#reasoning)

## [Text Summarization](https://www.promptingguide.ai/introduction/examples#text-summarization)

One of the standard tasks in natural language generation is text summarization. Text summarization can include many different flavors and domains. In fact, one of the most promising applications of language models is the ability to summarize articles and concepts into quick and easy-to-read summaries. Let's try a basic summarization task using prompts.

Let's say you are interested to learn about antibiotics, you could try a prompt like this:

**Prompt:**
```text
Explain antibiotics
A:
```

**Output:**
```text
Antibiotics are a type of medication used to treat bacterial infections. They work by either killing the bacteria or preventing them from reproducing, allowing the body’s immune system to fight off the infection. Antibiotics are usually taken orally in the form of pills, capsules, or liquid solutions, or sometimes administered intravenously. They are not effective against viral infections, and using them inappropriately can lead to antibiotic resistance.
```

The "A:" is an explicit prompt format that you use in question answering. You used it here to tell the model that there is an answer expected further. In this example, it's not clear how this is useful vs not using it but we will leave it that for later examples. Let's just assume that this is too much information and you want to summarize it further. In fact, you can instruct the model to summarize into one sentence like so:

**Prompt:**
```text
Antibiotics are a type of medication used to treat bacterial infections. They work by either killing the bacteria or preventing them from reproducing, allowing the body’s immune system to fight off the infection. Antibiotics are usually taken orally in the form of pills, capsules, or liquid solutions, or sometimes administered intravenously. They are not effective against viral infections, and using them inappropriately can lead to antibiotic resistance.
Explain the above in one sentence:
```

**Output:**
```text
Antibiotics are medications used to treat bacterial infections by either killing the bacteria or stopping them from reproducing, but they are not effective against viruses and overuse can lead to antibiotic resistance.
```

Without paying too much attention to the accuracy of the output above, which is something we will touch on in a later guide, the model tried to summarize the paragraph in one sentence. You can get clever with the instructions but we will leave that for a later chapter. Feel free to pause here and experiment to see if you get better results.

## [Information Extraction](https://www.promptingguide.ai/introduction/examples#information-extraction)

While language models are trained to perform natural language generation and related tasks, it's also very capable of performing classification and a range of other natural language processing (NLP) tasks.

Here is an example of a prompt that extracts information from a given paragraph.

**Prompt:**
```text
Author-contribution statements and acknowledgements in research papers should state clearly and specifically whether, and to what extent, the authors used AI technologies such as ChatGPT in the preparation of their manuscript and analysis. They should also indicate which LLMs were used. This will alert editors and reviewers to scrutinize manuscripts more carefully for potential biases, inaccuracies and improper source crediting. Likewise, scientific journals should be transparent about their use of LLMs, for example when selecting submitted manuscripts.
Mention the large language model based product mentioned in the paragraph above:
```

**Output:**
```text
The large language model based product mentioned in the paragraph above is ChatGPT.
```

There are many ways you can improve the results above, but this is already very useful.

By now it should be obvious that you can ask the model to perform different tasks by simply instructing it what to do. That's a powerful capability that AI product developers are already using to build powerful products and experiences.

Paragraph source: [ChatGPT: five priorities for research](https://www.nature.com/articles/d41586-023-00288-7)

## [Question Answering](https://www.promptingguide.ai/introduction/examples#question-answering)

One of the best ways to get the model to respond with specific answers is to improve the format of the prompt. As covered before, a prompt could combine instructions, context, input, and output indicators to get improved results. While these components are not required, it becomes a good practice as the more specific you are with instruction, the better results you will get. Below is an example of how this would look following a more structured prompt.

**Prompt:**
```text
Answer the question based on the context below. Keep the answer short and concise. Respond "Unsure about answer" if not sure about the answer.
Context: Teplizumab traces its roots to a New Jersey drug company called Ortho Pharmaceutical. There, scientists generated an early version of the antibody, dubbed OKT3. Originally sourced from mice, the molecule was able to bind to the surface of T cells and limit their cell-killing potential. In 1986, it was approved to help prevent organ rejection after kidney transplants, making it the first therapeutic antibody allowed for human use.
Question: What was OKT3 originally sourced from?
Answer:
```

**Output:**
```text
Mice.
```

Context obtained from [Nature](https://www.nature.com/articles/d41586-023-00400-x).

## [Text Classification](https://www.promptingguide.ai/introduction/examples#text-classification)

So far, you have used simple instructions to perform a task. As a prompt engineer, you need to get better at providing better instructions. But that's not all! You will also find that for harder use cases, just providing instructions won't be enough. This is where you need to think more about the context and the different elements you can use in a prompt. Other elements you can provide are `input data` or `examples`.

Let's try to demonstrate this by providing an example of text classification.

**Prompt:**
```text
Classify the text into neutral, negative or positive.
Text: I think the food was okay.
Sentiment:
```

**Output:**
```text
Neutral
```

You gave the instruction to classify the text and the model responded with `'Neutral'`, which is correct. Nothing is wrong with this but let's say that what you really need is for the model to give the label in the exact format you want. So instead of `Neutral`, you want it to return `neutral`. How do you achieve this? There are different ways to do this. You care about specificity here, so the more information you can provide the prompt, the better results. You can try providing examples to specify the correct behavior. Let's try again:

**Prompt:**
```text
Classify the text into neutral, negative or positive.
Text: I think the vacation is okay.
Sentiment: neutral
Text: I think the food was okay.
Sentiment:
```

**Output:**
```text
neutral
```

Perfect! This time the model returned `neutral` which is the specific label you were looking for. It seems that the example provided in the prompt helped the model to be specific in its output.

To highlight why sometimes being specific is important, check out the example below and spot the problem:

**Prompt:**
```text
Classify the text into nutral, negative or positive.
Text: I think the vacation is okay.
Sentiment:
```

**Output:**
```text
Neutral
```

What is the problem here? As a hint, the made-up `nutral` label is completely ignored by the model. Instead, the model outputs `Neutral` as it has some bias towards that label. But let's assume that what you really want is `nutral`. How would you fix this? Maybe you can try adding descriptions to the labels or add more examples to the prompt? If you are not sure, we will discuss a few ideas in the upcoming sections.

## [Conversation](https://www.promptingguide.ai/introduction/examples#conversation)

Perhaps one of the more interesting things you can achieve with prompt engineering is instructing the LLM system on how to behave, its intent, and its identity. This is particularly useful when you are building conversational systems like customer service chatbots.

For instance, let's create a conversational system that's able to generate more technical and scientific responses to questions. Note how you are explicitly telling it how to behave through the instruction. This is sometimes referred to as _role prompting_.

**Prompt:**
```text
The following is a conversation with an AI research assistant. The assistant tone is technical and scientific.
Human: Hello, who are you?
AI: Greeting! I am an AI research assistant. How can I help you today?
Human: Can you tell me about the creation of blackholes?
AI:
```

**Output:**
```text
Sure! Black holes are regions of spacetime where the gravitational force is so strong that nothing, not even light, can escape from it. They are created when a very massive star dies and its core collapses in on itself, forming a singularity of infinite density. The intense gravity of the singularity pulls in all the matter and radiation around it, creating the black hole.
```

Our AI research assistant sounds a bit too technical, right? Okay, let's change this behavior and instruct the system to give more accessible answers.

**Prompt:**
```text
The following is a conversation with an AI research assistant. The assistant answers should be easy to understand even by primary school students.
Human: Hello, who are you?
AI: Greeting! I am an AI research assistant. How can I help you today?
Human: Can you tell me about the creation of black holes?
AI:
```

**Output:**
```text
Sure! Black holes are created when a very massive star runs out of fuel and collapses in on itself. The gravity of the star is so strong that nothing, not even light, can escape its pull. This creates a point in space-time with an intense gravitational force called a black hole.
```

You made some progress. You can continue improving it. If you add more examples, you might get even better results.

## [Code Generation](https://www.promptingguide.ai/introduction/examples#code-generation)

One application where LLMs are quite effective is code generation. Copilot is a great example of this. There are a vast number of code-generation tasks you can perform with clever prompts. Let's look at a few examples below.

First, let's try a simple program that greets the user.

**Prompt:**
```text
/*
Ask the user for their name and say "Hello"
*/
```

**Output:**
```javascript
let name = prompt("What is your name?");
console.log(`Hello, ${name}!`);
```

Notice that you didn't even need to specify the language to use.

Let's switch levels a bit. The example below shows how powerful LLMs can be with a little more effort in designing the prompts.

**Prompt:**
```text
"""
Table departments, columns = [DepartmentId, DepartmentName]
Table students, columns = [DepartmentId, StudentId, StudentName]
Create a MySQL query for all students in the Computer Science Department
"""
```

**Output:**
```sql
SELECT StudentId, StudentName FROM students WHERE DepartmentId IN (SELECT DepartmentId FROM departments WHERE DepartmentName = 'Computer Science');
```

This is very impressive. In this case, you provided data about the database schema and asked it to generate a valid MySQL query.

## [Reasoning](https://www.promptingguide.ai/introduction/examples#reasoning)

Perhaps one of the most difficult tasks for an LLM today is one that requires some form of reasoning. Reasoning is one of most interesting areas due to the types of complex applications that can emerge from LLMs.

There have been some improvements in tasks involving mathematical capabilities. That said, it's important to note that current LLMs struggle to perform reasoning tasks so this requires even more advanced prompt engineering techniques. We will cover these advanced techniques in the next guide. For now, we will cover a few basic examples to show arithmetic capabilities.

**Prompt:**
```text
What is 9,000 * 9,000?
```

**Output:**
```text
81,000,000
```

Let's try something more difficult.

**Prompt:**
```text
The odd numbers in this group add up to an even number: 15, 32, 5, 13, 82, 7, 1.
A:
```

**Output**
```text
No, the odd numbers in this group add up to an odd number: 119.
```

That's incorrect! Let's try to improve this by improving the prompt.

**Prompt:**
```text
The odd numbers in this group add up to an even number: 15, 32, 5, 13, 82, 7, 1.
Solve by breaking the problem into steps. First, identify the odd numbers, add them, and indicate whether the result is odd or even.
```

**Output:**
```text
Odd numbers: 15, 5, 13, 7, 1
Sum: 41
41 is an odd number.
```

Much better, right? By the way, we tried this task a couple of times and the model sometimes fails. If you provide better instructions combined with examples, it might help get more accurate results.

In the upcoming section, we will cover even more advanced prompt engineering concepts and techniques for improving performance on all these and more difficult tasks.

## [Notebook](https://www.promptingguide.ai/introduction/examples#notebook)

If you want to practice with the prompts above using Python, we have prepared a notebook to test some of the prompts using the OpenAI models.
