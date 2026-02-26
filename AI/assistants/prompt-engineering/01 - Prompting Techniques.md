Prompt Engineering helps to effectively design and improve prompts to get better results on different tasks with LLMs.

While the previous basic examples were fun, in this section we cover more advanced prompting engineering techniques that allow us to achieve more complex tasks and improve reliability and performance of LLMs.


> [!INFO] **Table of Contents**
> - [Zero-shot Prompting](https://www.promptingguide.ai/techniques/zeroshot)
> - [Few-shot Prompting](https://www.promptingguide.ai/techniques/fewshot)
> - [Chain-of-Thought Prompting](https://www.promptingguide.ai/techniques/cot)
> - [Meta Prompting](https://www.promptingguide.ai/techniques/meta-prompting)
> - [Self-Consistency](https://www.promptingguide.ai/techniques/consistency)
> - [Generate Knowledge Prompting](https://www.promptingguide.ai/techniques/knowledge)
> - [Prompt Chaining](https://www.promptingguide.ai/techniques/prompt_chaining)
> - [Tree of Thoughts](https://www.promptingguide.ai/techniques/tot)
> - [Retrieval Augmented Generation](https://www.promptingguide.ai/techniques/rag)
> - [Automatic Reasoning and Tool-use](https://www.promptingguide.ai/techniques/art)
> - [Automatic Prompt Engineer](https://www.promptingguide.ai/techniques/ape)
> - [Active-Prompt](https://www.promptingguide.ai/techniques/activeprompt)
> - [Directional Stimulus Prompting](https://www.promptingguide.ai/techniques/dsp)
> - [Program-Aided Language Models](https://www.promptingguide.ai/techniques/pal)
> - [ReAct](https://www.promptingguide.ai/techniques/react)
> - [Reflexion](https://www.promptingguide.ai/techniques/reflexion)
> - [Multimodal CoT](https://www.promptingguide.ai/techniques/multimodalcot)
> - [Graph Prompting](https://www.promptingguide.ai/techniques/graph)


---
# Zero-Shot Prompting

Large language models (LLMs) today, such as GPT-3.5 Turbo, GPT-4, and Claude 3, are tuned to follow instructions and are trained on large amounts of data. Large-scale training makes these models capable of performing some tasks in a "zero-shot" manner. Zero-shot prompting means that the prompt used to interact with the model won't contain examples or demonstrations. The zero-shot prompt directly instructs the model to perform a task without any additional examples to steer it.

We tried a few zero-shot examples in the previous section. Here is one of the examples (ie., text classification) we used:

> [!example] Prompt
> ```
> Classify the text into neutral, negative or positive.
> Text: I think the vacation is okay.
> Sentiment:
> ```
>
> > [!success] Output
> > ```
> > Neutral
> > ```

Note that in the prompt above we didn't provide the model with any examples of text alongside their classifications, the LLM already understands "sentiment" -- that's the zero-shot capabilities at work.

Instruction tuning has been shown to improve zero-shot learning [Wei et al. (2022)](https://arxiv.org/pdf/2109.01652.pdf). Instruction tuning is essentially the concept of finetuning models on datasets described via instructions. Furthermore, [RLHF](https://arxiv.org/abs/1706.03741) (reinforcement learning from human feedback) has been adopted to scale instruction tuning wherein the model is aligned to better fit human preferences. This recent development powers models like ChatGPT. We will discuss all these approaches and methods in upcoming sections.

When zero-shot doesn't work, it's recommended to provide demonstrations or examples in the prompt which leads to few-shot prompting. In the next section, we demonstrate few-shot prompting.

## [Youtube video](https://youtu.be/ZTaHqdkxUMs)

> [!NOTE]- **Video Transcript: Zero-Shot Prompting**
> Hi everyone! In this video, I want to talk a little bit about zero-shot prompting. So, when we are using these large language models like GPT-3.5 Turbo and the latest GPT-4 or Claude, or any of these language models that have been trained and that are great at performing all sorts of tasks (as we saw in the previous video), when we're doing that, typically the way we prompt these models is by an approach or a method called zero-shot prompting.
>
> Now, what do we mean by zero-shot prompting? So, here's an example to illustrate what we mean by that, and I will explain in a minute what that actually entails. So, I'm going to actually take this prompt, and this is a prompt that I already tested and demonstrated in the previous recording that we did, where we talked about some examples of prompting, and this was a text classification example.
>
> So I'm going to take this. It's easier to show in the playground and to kind of demonstrate to you how it works with the GPT-3.5 Turbo model. So this one is doing what we refer to as sentiment analysis. You can also call it sentiment classification. And the idea with this task is that you would pass to the model some input, and then the model would predict the sentiment: if it's neutral, negative, or positive.
>
> So what I'm going to do here, just to improve this prompt a bit, I'm going to actually add this here. This is a prompt that is meant to classify text, so the model will understand that this is that type of task just by looking at the structure and the way I have designed this system prompt, and also by the use of this output indicator, which, as I mentioned in a previous guide, the importance of that.
>
> So you can see here that the model predicted this to be **Neutral**, which is the correct label or the correct class for this particular input that we have here. So that looks to be working.
>
> And so the question is: how does this model know that it should perform this particular task and classify this input text, right? The input text here into either of these? How does it have knowledge and understanding of this task?
>
> And the reason for that is that this model has been trained on large-scale web data, right? But it has also been trained on all sorts of datasets out there as well that might already have examples of, you know, of something that looks like sentiment classification, right? So there are tons of datasets out there. Um, there's a lot of content out there that might already have this structure. The model out of the box kind of understands how to perform the task, right? And for this task, you might not need to do what we refer to as fine-tuning or tune the model to perform this task well.
>
> So at first glance, right, we see that the model is performing really well. We see that the assistant sent us this **Neutral**. It looks to be working okay. And you can test it out by trying a different input here. So I'm just going to go here and try "I am feeling excited today". Okay, then I'm going to try it out again, and you can see that this one is **Positive**.
>
> So you can see that this model does have some knowledge of this particular task. It knows the sentiment that this input text is eliciting, right? So that's very good to see.
>
> Now, I'm trying different examples here, but in reality, as a developer, as a researcher, you may need to put together large datasets to evaluate whether this model is doing it correctly. For now, this is out of scope, but this is something we are going to discuss in a later video. We will be publishing something about fine-tuning later down the road, and we will also be using this particular use case. It's a very popular use case, this one of text classification, where we share like how we try different types of prompting techniques and how it compares with something like fine-tuning.
>
> I want to go back here. I did mention here in this guide, uh, a really important resource here that discusses this idea of instruction tuning. And instruction tuning, basically, you can... you will need something like a prompt response or like an input response where you're training the model to... when the model sees those inputs, it is going to have a certain type of response, right?
>
> So if you're fine-tuning these models and the model has, you know, something that looks quite similar to this type of task, it will have an understanding on how to perform the task, right? So a lot of these models, they have those zero-shot capabilities that we can leverage, and that's really key and important for how we use these models today.
>
> So if you use something like ChatGPT, right, when you go there, you're not thinking about, "Oh, I need to provide the model knowledge or additional knowledge or provide the model examples of how to perform the task." No. You go there and essentially what you expect as a user is the model to be able to perform that task really well.
>
> However, I must say, in reality, a lot of real-world applications of large language models require you to put together demonstrations to steer the model better for the results that you want to see. And for that, we have what we refer to as **few-shot in-context learning** or **few-shot prompting**. And that's something that we will also be discussing in a future video as well. So, uh, look forward to that. That will be an interesting one as well that we will share with some examples as well.
>
> So that's the idea of zero-shot, right? So here you can see that I am not really providing the model any examples. And how would that look like if I'm providing examples? Again, we will discuss this in a future video, but for now, you can see that this model has potentially the capability to do this type of text classification.
>
> And in fact, if you go back to our examples that we shared in the previous guide, you will see that there's all these tasks, um, foundational tasks that we asked the model to perform, right? Like text summarization, information extraction, question answering. If you look at these examples, you will see that there is also... these are all zero-shot prompts in the sense that we're not really giving the model any examples on how to perform the task. We're just telling it: here is a piece of text and do something with it, right? Summarize text, extract information, and so on. We just expect the model to do it really well.
>
> The good thing is that a lot of researchers are really working hard for these models to be able to perform really well in the zero-shot setting. Realistically speaking, today it is the case that for some tasks, at least the more common tasks, it will work. So a lot of things like information extraction, the model might be able to do that task, you know, in a zero-shot setting.
>
> But in a lot of cases in the real world, when you're deploying models and so on, you may need to consider adding demonstrations and examples to better steer the model to get the results that you really want for your task. So that's a little bit about zero-shot prompting. Hopefully, that clarifies a little bit on what it is.
>
> If you enjoyed the video or found it useful, please give a like and subscribe to the channel. We'll be posting a lot more new videos about all of these like prompting techniques. And if you have any questions about those, also leave them in the comments. If you have any ideas on videos that you would like to see or maybe a concept that needs further explanation, also feel free to comment on that and I'll be looking at all of those and you know, decide which ones make sense to do a video on. So that's it for today. Thank you so much for watching the video and see you in the next one.


---
# Few-Shot Prompting

While large-language models demonstrate remarkable zero-shot capabilities, they still fall short on more complex tasks when using the zero-shot setting. Few-shot prompting can be used as a technique to enable in-context learning where we provide demonstrations in the prompt to steer the model to better performance. The demonstrations serve as conditioning for subsequent examples where we would like the model to generate a response.

According to [Touvron et al. 2023](https://arxiv.org/pdf/2302.13971.pdf) few shot properties first appeared when models were scaled to a sufficient size [(Kaplan et al., 2020)](https://arxiv.org/abs/2001.08361).

Let's demonstrate few-shot prompting via an example that was presented in [Brown et al. 2020](https://arxiv.org/abs/2005.14165). In the example, the task is to correctly use a new word in a sentence.

> [!example] Prompt
> ```
> A "whatpu" is a small, furry animal native to Tanzania. An example of a sentence that uses the word whatpu is:
> We were traveling in Africa and we saw these very cute whatpus.
>
> To do a "farduddle" means to jump up and down really fast. An example of a sentence that uses the word farduddle is:
> ```
>
> > [!success] Output
> > ```
> > When we won the game, we all started to farduddle in celebration.
> > ```

We can observe that the model has somehow learned how to perform the task by providing it with just one example (i.e., 1-shot). For more difficult tasks, we can experiment with increasing the demonstrations (e.g., 3-shot, 5-shot, 10-shot, etc.).

Following the findings from [Min et al. (2022)](https://arxiv.org/abs/2202.12837), here are a few more tips about demonstrations/exemplars when doing few-shot:

- "the label space and the distribution of the input text specified by the demonstrations are both important (regardless of whether the labels are correct for individual inputs)"
- the format you use also plays a key role in performance, even if you just use random labels, this is much better than no labels at all.
- additional results show that selecting random labels from a true distribution of labels (instead of a uniform distribution) also helps.

Let's try out a few examples. Let's first try an example with random labels (meaning the labels Negative and Positive are randomly assigned to the inputs):

> [!example] Prompt
> ```
> This is awesome! // Negative
> This is bad! // Positive
> Wow that movie was rad! // Positive
> What a horrible show! //
> ```
>
> > [!success] Output
> > ```
> > Negative
> > ```

We still get the correct answer, even though the labels have been randomized. Note that we also kept the format, which helps too. In fact, with further experimentation, it seems the newer GPT models we are experimenting with are becoming more robust to even random formats. Example:

> [!example] Prompt
> ```
> Positive This is awesome!
> This is bad! Negative
> Wow that movie was rad!Positive
> What a horrible show! --
> ```
>
> > [!success] Output
> > ```
> > Negative
> > ```

There is no consistency in the format above but the model still predicted the correct label. We have to conduct a more thorough analysis to confirm if this holds for different and more complex tasks, including different variations of prompts.

### Limitations of Few-shot Prompting[](https://www.promptingguide.ai/techniques/fewshot#limitations-of-few-shot-prompting)

Standard few-shot prompting works well for many tasks but is still not a perfect technique, especially when dealing with more complex reasoning tasks. Let's demonstrate why this is the case. Do you recall the previous example where we provided the following task:

```
The odd numbers in this group add up to an even number: 15, 32, 5, 13, 82, 7, 1. A:
```

If we try this again, the model outputs the following:

```
Yes, the odd numbers in this group add up to 107, which is an even number.
```

This is not the correct response, which not only highlights the limitations of these systems but that there is a need for more advanced prompt engineering.

Let's try to add some examples to see if few-shot prompting improves the results.

> [!example] Prompt
> ```
> The odd numbers in this group add up to an even number: 4, 8, 9, 15, 12, 2, 1.
> A: The answer is False.
>
> The odd numbers in this group add up to an even number: 17,  10, 19, 4, 8, 12, 24.
> A: The answer is True.
>
> The odd numbers in this group add up to an even number: 16,  11, 14, 4, 8, 13, 24.
> A: The answer is True.
>
> The odd numbers in this group add up to an even number: 17,  9, 10, 12, 13, 4, 2.
> A: The answer is False.
>
> The odd numbers in this group add up to an even number: 15, 32, 5, 13, 82, 7, 1. A:
> ```
>
> > [!failure] Output
> > ```
> > The answer is True.
> > ```

That didn't work. It seems like few-shot prompting is not enough to get reliable responses for this type of reasoning problem. The example above provides basic information on the task. If you take a closer look, the type of task we have introduced involves a few more reasoning steps. In other words, it might help if we break the problem down into steps and demonstrate that to the model. More recently, [chain-of-thought (CoT) prompting](https://arxiv.org/abs/2201.11903) has been popularized to address more complex arithmetic, commonsense, and symbolic reasoning tasks.

Overall, it seems that providing examples is useful for solving some tasks. When zero-shot prompting and few-shot prompting are not sufficient, it might mean that whatever was learned by the model isn't enough to do well at the task. From here it is recommended to start thinking about fine-tuning your models or experimenting with more advanced prompting techniques. Up next we talk about one of the popular prompting techniques called chain-of-thought prompting which has gained a lot of popularity.

## [Youtube video](https://youtu.be/ojtbHUqw1LA)
> [!NOTE]- **Video Transcript: Few-Shot Prompting**
> In this video, we are going to go over the concept of few-shot prompting. So, few-shot prompting is one of the more popular ways of prompting large language models to be able to improve performance and reliability in terms of the results and output quality that we would like from these LLMs.
>
> In the previous guide, we covered the idea of zero-shot prompting, and we have a video for it here if you're interested in what that concept is. But basically, what we do with zero-shot is call a model or perform a task by just giving the model an instruction. So an instruction can be "classify the text into neutral, negative, or positive", then you give the model the input which is going to be this text "I think the vacation is okay", and then this output indicator here is telling the model that we're expecting an output which will be one of these labels.
>
> And so this, you can consider a classification task, is also considered uh zero-shot prompting because we're not adding examples, right? We're not giving the model examples of how to perform this task. We are making an assumption that the model has some internal understanding of what this task is, and obviously, this is a pattern recognition system that can understand what the task is and what the intent is and be able to provide the right answers, in this case, the labels.
>
> Now, this is a good first way of experimenting with large language models, but these models lack capabilities in a lot of areas, and that would be for areas where maybe they haven't seen enough data, they don't understand really the task, right? It could be also a very complex task that the model has very little understanding of or very little knowledge of. And in those cases, you may want to experiment with something called few-shot prompting, and this is what we're going to cover now.
>
> And few-shot prompting, the aim would be to add examples or give the model demonstrations, right? You show it how to perform the task, and then by showing it, the model can understand better what that task is about and be able to perform better.
>
> So let's go back to few-shot prompting here, which is the next guide after zero-shot prompting. So what we'll do is we'll start with this simple example and then we'll move on to a more interesting example. So this one is from the Brown et al. paper, this is the GPT-3 paper if I'm not mistaken, and this is directly copy-pasted from that paper. And this basically shows you the idea of this few-shot prompting technique.
>
> So we're going to copy this and we're going to move it over to the playground. Again, the playground that I'm using here is from OpenAI because we're using the OpenAI models, and in particular, I'm using GPT-3.5. But you could use any of the other models that you see available here in the playground.
>
> What I'm going to do now is I'm going to use the system message. So I need to provide a system message here, that's absolutely required now in the playground. So what I can do is I can copy-paste this for now, but because this requires a system message before I input a user message, what I can do is I can actually divide this into two parts.
>
> So there are many ways how you can design the prompt itself, right? With the different roles like system role, user role, and also the assistant role. But in this case, what we want is we want to perform this particular task and we don't really want to add too many instructions. What we just want to do is we just want to give the model the examples, which in this case you can see in the examples, it's making up a word, right? And it's defining the word and then it's instructing the model to come up with an example of a sentence that uses the word.
>
> But before it does that, it gives it a demonstration on how to perform that task. So you set the expectation basically for the model. So you can see that this particular demonstration shows what is the input, which will be the word, and what will be the expected output, which is the sentence where that word is used. That made-up word, again, these are made-up words. So it's remarkable that this model can come up with a sentence right on the fly about this particular word without us having to fine-tune that model or us having to tune the weights of that model to tell it what this is about. So that's really the power of few-shot prompting.
>
> So what I'm going to do here to make this work, I can actually just go here to keep it really simple and I'll add this as part of the user role. So what I can do is I can just uh add this and then now I have the system message. So this is the demonstration and then I have this which will be the input. That makes sense for me to compose it this way. There are many other ways how you can go about doing this. You could have also taken this and put it right there, just leave it there where I had it, and then maybe add something in the user role, some other additional instruction. Uh, there are different ways, but I find that this is the best way to do it uh with these models and using these roles.
>
> So once I have that, I can now run this. So you can see here it says uh "let's read the input message first to do a farduddle means to jump up and down really fast an example of a sentence that uses the word farduddle is", and then from the model we get the response which is "I couldn't contain my excitement when I found out I won the race so I started to farduddle right there on the spot". So I think it's properly using the word in a sentence and that's great to see, right? Because that's what we wanted with this particular task.
>
> Now, this is a very simple task. We actually got this from the paper and it was exciting at the time when we showed that we could do this with large language models because this generalizes, right? Now you can use this uh here in this case is a toy example but you can use this for okay if you want a specific tone in an email you can provide demonstrations of those emails if you want to have certain headlines or you want to use them all to come up with headline suggestions for or heading suggestions for your essays or something like that then you can give them all some examples of maybe previous essay that you think have the style that you want and then the model should be able to follow that to some extent right that's the idea of f shot prompting you're basically telling the model or demonstrating to the model what you expect in terms of the type of output the quality of the output right the tone perhaps as well the style of it it could also be in this case defining of words giving it knowledge about certain Concepts as well there are different ways how you can use fuchia promp this is a basic toy example
>
> Now I'm going to delete this. So let me just delete this part here and then what I'm going to do is I'm going to copy over the second example. We have a second example here in the guide. It'll be recommended for you to read the guide there. There are also some additional readings if you're interested in going into more details but I'm trying to give you more or less a recap of what the idea is.
>
> So what I'm going to do is I'm going to copy this over and I'm going to paste it right here. So the way I can structure this right for every task will be a little bit different. Now I know this is uh classification task so what I can do here is I can tell it "your task is to perform uh sentiment classification on the provided inputs you will classify the text input into either negative or positive". So that's my task. I could have improved this a bit better but for now we will keep it as is.
>
> The instructions usually go in the system message so I have it in the system message already and what I can do is I can provide it the examples here and I could use something like this as well that's totally fine. I see a lot of people actually use this these type of indicators here or what we call as delimiters or you can call it like subheadings or whatever you may want to call it and that's totally fine I think that's something that the model should be able to Leverage as well to better understand the task and better understand okay this part is going to be about examples.
>
> Notice that I have the examples here right so I have the input and I have the output here right input text and output of that input and output of that you could also design this a little bit different now I wanted to take a shortcut here because the way how I'm inputting this information is going to be with this you know additional uh indicator here right the additional characters but I could also use something like input text and then output right so I could I could change the way I'm formatting these examples and then I will have to carry that over to my final input that I'm providing for the model to classify.
>
> So here I'm just going to classify this and so we got negative from the model which is exactly the classification we expected. Now even this is a very simple task but as soon as you start to scale on tasks like this this model does tend to favor a certain label here or a certain category like maybe would favor positive or negative because it has seen potentially more positive right type of content in its training data so our task now is to sort of figure out what is the best strategy to provide these models the examples maybe the model is lacking the ability to perform a specific classification then in that case we can give it more examples of those so that it gets it right.
>
> Now this case you saw that I give it an input output that's not always required you don't always have to give it input output you can also give it output some Tas for instance where maybe you want a specific type of email right in a specific tone in that case you can just give it the email right you don't really need to give it an input in that case so some task would require input output but some you know you can just get away with just giving it the output that'll be it for this demo and hopefully it's more clear what this is about.
>
> Feel free to read here again understand also the limitations in the next video we are also going to cover Chain of Thought prompting which is another really powerful way of prompting these models that will be it for this particular video thanks for watching and catch you in the next one.

---
# Chain-of-Thought Prompting
Image Source: [Wei et al. (2022)](https://arxiv.org/abs/2201.11903)
![[Pasted image 20251229095132.png]]
Introduced in [Wei et al. (2022)](https://arxiv.org/abs/2201.11903), chain-of-thought (CoT) prompting enables complex reasoning capabilities through intermediate reasoning steps. You can combine it with few-shot prompting to get better results on more complex tasks that require reasoning before responding.

> [!example] Prompt
> ```
> The odd numbers in this group add up to an even number: 4, 8, 9, 15, 12, 2, 1.
> A: Adding all the odd numbers (9, 15, 1) gives 25. The answer is False.
>
> The odd numbers in this group add up to an even number: 17,  10, 19, 4, 8, 12, 24.
> A: Adding all the odd numbers (17, 19) gives 36. The answer is True.
>
> The odd numbers in this group add up to an even number: 16,  11, 14, 4, 8, 13, 24.
> A: Adding all the odd numbers (11, 13) gives 24. The answer is True.
>
> The odd numbers in this group add up to an even number: 17,  9, 10, 12, 13, 4, 2.
> A: Adding all the odd numbers (17, 9, 13) gives 39. The answer is False.
>
> The odd numbers in this group add up to an even number: 15, 32, 5, 13, 82, 7, 1. A:
> ```
>
> > [!success] Output
> > ```
> > Adding all the odd numbers (15, 5, 13, 7, 1) gives 41. The answer is False.
> > ```

Wow! We can see a perfect result when we provided the reasoning step. In fact, we can solve this task by providing even fewer examples, i.e., just one example seems enough:

> [!example] Prompt
> ```
> The odd numbers in this group add up to an even number: 4, 8, 9, 15, 12, 2, 1.
> A: Adding all the odd numbers (9, 15, 1) gives 25. The answer is False.
>
> The odd numbers in this group add up to an even number: 15, 32, 5, 13, 82, 7, 1. A:
> ```
>
> > [!success] Output
> > ```
> > Adding all the odd numbers (15, 5, 13, 7, 1) gives 41. The answer is False.
> > ```

Keep in mind that the authors claim that this is an emergent ability that arises with sufficiently large language models.

## Zero-shot COT Prompting[](https://www.promptingguide.ai/techniques/cot#zero-shot-cot-prompting)

![[Pasted image 20251229095205.png]]

Image Source: [Kojima et al. (2022)](https://arxiv.org/abs/2205.11916)

One recent idea that came out more recently is the idea of [zero-shot CoT](https://arxiv.org/abs/2205.11916) (Kojima et al. 2022) that essentially involves adding "Let's think step by step" to the original prompt. Let's try a simple problem and see how the model performs:

> [!example] Prompt
> ```
> I went to the market and bought 10 apples. I gave 2 apples to the neighbor and 2 to the repairman. I then went and bought 5 more apples and ate 1. How many apples did I remain with?
> ```
>
> > [!failure] Output
> > ```
> > 11 apples
> > ```

The answer is incorrect! Now Let's try with the special prompt.

> [!example] Prompt
> ```
> I went to the market and bought 10 apples. I gave 2 apples to the neighbor and 2 to the repairman. I then went and bought 5 more apples and ate 1. How many apples did I remain with?
> Let's think step by step.
> ```
>
> > [!success] Output
> > ```
> > First, you started with 10 apples.
> > You gave away 2 apples to the neighbor and 2 to the repairman, so you had 6 apples left.
> > Then you bought 5 more apples, so now you had 11 apples.
> > Finally, you ate 1 apple, so you would remain with 10 apples.
> > ```

It's impressive that this simple prompt is effective at this task. This is particularly useful where you don't have too many examples to use in the prompt.

## Automatic Chain-of-Thought (Auto-CoT)[](https://www.promptingguide.ai/techniques/cot#automatic-chain-of-thought-auto-cot)

When applying chain-of-thought prompting with demonstrations, the process involves hand-crafting effective and diverse examples. This manual effort could lead to suboptimal solutions. [Zhang et al. (2022)](https://arxiv.org/abs/2210.03493) propose an approach to eliminate manual efforts by leveraging LLMs with "Let's think step by step" prompt to generate reasoning chains for demonstrations one by one. This automatic process can still end up with mistakes in generated chains. To mitigate the effects of the mistakes, the diversity of demonstrations matter. This work proposes Auto-CoT, which samples questions with diversity and generates reasoning chains to construct the demonstrations.

Auto-CoT consists of two main stages:

- Stage 1): **question clustering**: partition questions of a given dataset into a few clusters
- Stage 2): **demonstration sampling**: select a representative question from each cluster and generate its reasoning chain using Zero-Shot-CoT with simple heuristics

The simple heuristics could be length of questions (e.g., 60 tokens) and number of steps in rationale (e.g., 5 reasoning steps). This encourages the model to use simple and accurate demonstrations.

The process is illustrated below:

![[Pasted image 20251229095216.png]]

Image Source: [Zhang et al. (2022)](https://arxiv.org/abs/2210.03493)

Code for Auto-CoT is available [here](https://github.com/amazon-science/auto-cot).

---
# Meta Prompting

## Introduction[](https://www.promptingguide.ai/techniques/meta-prompting#introduction)

Meta Prompting is an advanced prompting technique that focuses on the structural and syntactical aspects of tasks and problems rather than their specific content details. This goal with meta prompting is to construct a more abstract, structured way of interacting with large language models (LLMs), emphasizing the form and pattern of information over traditional content-centric methods.

## Key Characteristics[](https://www.promptingguide.ai/techniques/meta-prompting#key-characteristics)

According to [Zhang et al. (2024)](https://arxiv.org/abs/2311.11482), the key characteristics of meta prompting can be summarized as follows:

**1. Structure-oriented**: Prioritizes the format and pattern of problems and solutions over specific content.

**2. Syntax-focused**: Uses syntax as a guiding template for the expected response or solution.

**3. Abstract examples**: Employs abstracted examples as frameworks, illustrating the structure of problems and solutions without focusing on specific details.

**4. Versatile**: Applicable across various domains, capable of providing structured responses to a wide range of problems.

**5. Categorical approach**: Draws from type theory to emphasize the categorization and logical arrangement of components in a prompt.

## Advantages over Few-Shot Prompting[](https://www.promptingguide.ai/techniques/meta-prompting#advantages-over-few-shot-prompting)

[Zhang et al., 2024](https://arxiv.org/abs/2311.11482) report that meta prompting and few-shot prompting are different in that it meta prompting focuses on a more structure-oriented approach as opposed to a content-driven approach which few-shot prompting emphasizes.

The following example obtained from [Zhang et al. (2024)](https://arxiv.org/abs/2311.11482) demonstrates the difference between a structured meta prompt and a few-shot prompt for solving problems from the MATH benchmark:

!["Meta Prompting"](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fmeta-prompting.66b824be.png&w=1920&q=75)

The advantages of Meta Prompting over few-shot promoting include:

**1. Token efficiency**: Reduces the number of tokens required by focusing on structure rather than detailed content.

**2. Fair comparison**: Provides a more fair approach for comparing different problem-solving models by minimizing the influence of specific examples.

**3. Zero-shot efficacy**: Can be viewed as a form of zero-shot prompting, where the influence of specific examples is minimized.

## Applications[](https://www.promptingguide.ai/techniques/meta-prompting#applications)

By focusing on the structural patterns of problem-solving, Meta Prompting offers a clear roadmap for navigating complex topics, enhancing the reasoning capabilities of LLMs across various domains.

It's important to note that meta prompting also assumes that the LLM has innate knowledge about the specific task or problem being addressed. As LLMs can generalize to a unseen tasks, it is possible that they can be leveraged with meta prompting but performance might deteriorate with more unique and novel tasks as is the case with zero-shot prompting.

Applications where meta prompting can be beneficial include but not limited to complex reasoning tasks, mathematical problem-solving, coding challenges, theoretical queries.

---

# Self-Consistency

Perhaps one of the more advanced techniques out there for prompt engineering is self-consistency. Proposed by [Wang et al. (2022)](https://arxiv.org/abs/2203.11171), self-consistency aims "to replace the naive greedy decoding used in chain-of-thought prompting". The idea is to sample multiple, diverse reasoning paths through few-shot CoT, and use the generations to select the most consistent answer. This helps to boost the performance of CoT prompting on tasks involving arithmetic and commonsense reasoning.

Let's try the following example for arithmetic reasoning:

> [!example] Prompt
> ```
> When I was 6 my sister was half my age. Now I’m 70 how old is my sister?
> ```
>
> > [!failure] Output
> > ```
> > 35
> > ```

The output is wrong! How may we improve this with self-consistency? Let's try it out. We will use the few-shot exemplars from Wang et al. 2022 (Table 17):

_Prompt:_

```
Q: There are 15 trees in the grove. Grove workers will plant trees in the grove today. After they are done,there will be 21 trees. How many trees did the grove workers plant today?A: We start with 15 trees. Later we have 21 trees. The difference must be the number of trees they planted.So, they must have planted 21 - 15 = 6 trees. The answer is 6.Q: If there are 3 cars in the parking lot and 2 more cars arrive, how many cars are in the parking lot?A: There are 3 cars in the parking lot already. 2 more arrive. Now there are 3 + 2 = 5 cars. The answer is 5.Q: Leah had 32 chocolates and her sister had 42. If they ate 35, how many pieces do they have left in total?A: Leah had 32 chocolates and Leah’s sister had 42. That means there were originally 32 + 42 = 74chocolates. 35 have been eaten. So in total they still have 74 - 35 = 39 chocolates. The answer is 39.Q: Jason had 20 lollipops. He gave Denny some lollipops. Now Jason has 12 lollipops. How many lollipopsdid Jason give to Denny?A: Jason had 20 lollipops. Since he only has 12 now, he must have given the rest to Denny. The number oflollipops he has given to Denny must have been 20 - 12 = 8 lollipops. The answer is 8.Q: Shawn has five toys. For Christmas, he got two toys each from his mom and dad. How many toys doeshe have now?A: He has 5 toys. He got 2 from mom, so after that he has 5 + 2 = 7 toys. Then he got 2 more from dad, soin total he has 7 + 2 = 9 toys. The answer is 9.Q: There were nine computers in the server room. Five more computers were installed each day, frommonday to thursday. How many computers are now in the server room?A: There are 4 days from monday to thursday. 5 computers were added each day. That means in total 4 * 5 =20 computers were added. There were 9 computers in the beginning, so now there are 9 + 20 = 29 computers.The answer is 29.Q: Michael had 58 golf balls. On tuesday, he lost 23 golf balls. On wednesday, he lost 2 more. How manygolf balls did he have at the end of wednesday?A: Michael initially had 58 balls. He lost 23 on Tuesday, so after that he has 58 - 23 = 35 balls. OnWednesday he lost 2 more so now he has 35 - 2 = 33 balls. The answer is 33.Q: Olivia has $23. She bought five bagels for $3 each. How much money does she have left?A: She bought 5 bagels for $3 each. This means she spent $15. She has $8 left.Q: When I was 6 my sister was half my age. Now I’m 70 how old is my sister?A:
```

> [!success] Output 1
> ```
> When I was 6 my sister was half my age, so she was 3. Now I am 70, so she is 70 - 3 = 67. The answer is 67.
> ```

> [!success] Output 2
> ```
> When the narrator was 6, his sister was half his age, which is 3. Now that the narrator is 70, his sister would be 70 - 3 = 67 years old. The answer is 67.
> ```

> [!failure] Output 3
> ```
> When I was 6 my sister was half my age, so she was 3. Now I am 70, so she is 70/2 = 35. The answer is 35.
> ```

Computing for the final answer involves a few steps (check out the paper for the details) but for the sake of simplicity, we can see that there is already a majority answer emerging so that would essentially become the final answer.

---
# Generated Knowledge Prompting

![GENKNOW](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fgen-knowledge.055b8d37.png&w=1920&q=75)

Image Source: [Liu et al. 2022](https://arxiv.org/pdf/2110.08387.pdf)

LLMs continue to be improved and one popular technique includes the ability to incorporate knowledge or information to help the model make more accurate predictions.

Using a similar idea, can the model also be used to generate knowledge before making a prediction? That's what is attempted in the paper by [Liu et al. 2022](https://arxiv.org/pdf/2110.08387.pdf) -- generate knowledge to be used as part of the prompt. In particular, how helpful is this for tasks such as commonsense reasoning?

Let's try a simple prompt:

> [!example] Prompt
> ```
> Part of golf is trying to get a higher point total than others. Yes or No?
> ```
>
> > [!failure] Output
> > ```
> > Yes.
> > ```

This type of mistake reveals the limitations of LLMs to perform tasks that require more knowledge about the world. How do we improve this with knowledge generation?

First, we generate a few "knowledges":

_Prompt:_

```
Input: Greece is larger than mexico.Knowledge: Greece is approximately 131,957 sq km, while Mexico is approximately 1,964,375 sq km, making Mexico 1,389% larger than Greece.Input: Glasses always fog up.Knowledge: Condensation occurs on eyeglass lenses when water vapor from your sweat, breath, and ambient humidity lands on a cold surface, cools, and then changes into tiny drops of liquid, forming a film that you see as fog. Your lenses will be relatively cool compared to your breath, especially when the outside air is cold.Input: A fish is capable of thinking.Knowledge: Fish are more intelligent than they appear. In many areas, such as memory, their cognitive powers match or exceed those of ’higher’ vertebrates including non-human primates. Fish’s long-term memories help them keep track of complex social relationships.Input: A common effect of smoking lots of cigarettes in one’s lifetime is a higher than normal chance of getting lung cancer.Knowledge: Those who consistently averaged less than one cigarette per day over their lifetime had nine times the risk of dying from lung cancer than never smokers. Among people who smoked between one and 10 cigarettes per day, the risk of dying from lung cancer was nearly 12 times higher than that of never smokers.Input: A rock is the same size as a pebble.Knowledge: A pebble is a clast of rock with a particle size of 4 to 64 millimetres based on the Udden-Wentworth scale of sedimentology. Pebbles are generally considered larger than granules (2 to 4 millimetres diameter) and smaller than cobbles (64 to 256 millimetres diameter).Input: Part of golf is trying to get a higher point total than others.Knowledge:
```

> [!info] Knowledge 1
> ```
> The objective of golf is to play a set of holes in the least number of strokes. A round of golf typically consists of 18 holes. Each hole is played once in the round on a standard golf course. Each stroke is counted as one point, and the total number of strokes is used to determine the winner of the game.
> ```

> [!info] Knowledge 2
> ```
> Golf is a precision club-and-ball sport in which competing players (or golfers) use many types of clubs to hit balls into a series of holes on a course using the fewest number of strokes. The goal is to complete the course with the lowest score, which is calculated by adding up the total number of strokes taken on each hole. The player with the lowest score wins the game.
> ```

We are using the prompt provided in the paper by [Liu et al. 2022](https://arxiv.org/pdf/2110.08387.pdf).

The next step is to integrate the knowledge and get a prediction. I reformatted the question into QA format to guide the answer format.

> [!example] Prompt
> ```
> Question: Part of golf is trying to get a higher point total than others. Yes or No?
>
> Knowledge: The objective of golf is to play a set of holes in the least number of strokes. A round of golf typically consists of 18 holes. Each hole is played once in the round on a standard golf course. Each stroke is counted as one point, and the total number of strokes is used to determine the winner of the game.
>
> Explain and Answer:
> ```
>
> > [!success] Answer 1 (confidence very high)
> > ```
> > No, the objective of golf is not to get a higher point total than others. Rather, the objective is to play a set of holes in the least number of strokes. The total number of strokes is used to determine the winner of the game, not the total number of points.
> > ```

> [!example] Prompt
> ```
> Question: Part of golf is trying to get a higher point total than others. Yes or No?
>
> Knowledge: Golf is a precision club-and-ball sport in which competing players (or golfers) use many types of clubs to hit balls into a series of holes on a course using the fewest number of strokes. The goal is to complete the course with the lowest score, which is calculated by adding up the total number of strokes taken on each hole. The player with the lowest score wins the game.
>
> Explain and Answer:
> ```
>
> > [!failure] Answer 2 (confidence is a lot lower)
> > ```
> > Yes, part of golf is trying to get a higher point total than others. Each player tries to complete the course with the lowest score, which is calculated by adding up the total number of strokes taken on each hole. The player with the lowest score wins the game.
> > ```

Some really interesting things happened with this example. In the first answer, the model was very confident but in the second not so much. I simplified the process for demonstration purposes but there are a few more details to consider when arriving at the final answer. Check out the paper for more.

---

# Prompt Chaining

## Introduction to Prompt Chaining[](https://www.promptingguide.ai/techniques/prompt_chaining#introduction-to-prompt-chaining)

To improve the reliability and performance of LLMs, one of the important prompt engineering techniques is to break tasks into its subtasks. Once those subtasks have been identified, the LLM is prompted with a subtask and then its response is used as input to another prompt. This is what's referred to as prompt chaining, where a task is split into subtasks with the idea to create a chain of prompt operations.

Prompt chaining is useful to accomplish complex tasks which an LLM might struggle to address if prompted with a very detailed prompt. In prompt chaining, chain prompts perform transformations or additional processes on the generated responses before reaching a final desired state.

Besides achieving better performance, prompt chaining helps to boost the transparency of your LLM application, increases controllability, and reliability. This means that you can debug problems with model responses much more easily and analyze and improve performance in the different stages that need improvement.

Prompt chaining is particularly useful when building LLM-powered conversational assistants and improving the personalization and user experience of your applications.

## Use Cases for Prompt Chaining[](https://www.promptingguide.ai/techniques/prompt_chaining#use-cases-for-prompt-chaining)

### Prompt Chaining for Document QA[](https://www.promptingguide.ai/techniques/prompt_chaining#prompt-chaining-for-document-qa)

Prompt chaining can be used in different scenarios that could involve several operations or transformations. For instance, one common use case of LLMs involves answering questions about a large text document. It helps if you design two different prompts where the first prompt is responsible for extracting relevant quotes to answer a question and a second prompt takes as input the quotes and original document to answer a given question. In other words, you will be creating two different prompts to perform the task of answering a question given in a document.

The first prompt below extracts the relevant quotes from the document given the question. Note that for simplicity, we have added a placeholder for the document `{{document}}`. To test the prompt you can copy and paste an article from Wikipedia such as this page for [prompt engineering](https://en.wikipedia.org/wiki/Prompt_engineering). Due to larger context used for this task, we are using the `gpt-4-1106-preview` model from OpenAI. You can use the prompt with other long-context LLMs like Claude.

> [!example] Prompt 1
> ```
> You are a helpful assistant. Your task is to help answer a question given in a document. The first step is to extract quotes relevant to the question from the document, delimited by ####. Please output the list of quotes using <quotes></quotes>. Respond with "No relevant quotes found!" if no relevant quotes were found.####{{document}}####
> ```

Here is a screenshot of the entire prompt including the question which is passed using the `user` role.

![Prompt Chaining Part 1](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprompt-chaining-1.4bdd376c.png&w=1920&q=75)

> [!success] Output of Prompt 1
> ```
> <quotes>
> - Chain-of-thought (CoT) prompting[27]
> - Generated knowledge prompting[37]
> - Least-to-most prompting[38]
> - Self-consistency decoding[39]
> - Complexity-based prompting[41]
> - Self-refine[42]
> - Tree-of-thought prompting[43]
> - Maieutic prompting[45]
> - Directional-stimulus prompting[46]
> - Textual inversion and embeddings[59]
> - Using gradient descent to search for prompts[61][62][63][64]
> - Prompt injection[65][66][67]
> </quotes>
> ```

The quotes that were returned in the first prompt can now be used as input to the second prompt below. Note that you can clean up the quotes a bit more, i.e., remove the citations. Those citations could be removed or utilized as part of another prompt in the chain but you can ignore this for now. The second prompt then takes the relevant quotes extracted by prompt 1 and prepares a helpful response to the question given in the document and those extracted quotes. The second prompt can be the following:

> [!example] Prompt 2
> ```
> Given a set of relevant quotes (delimited by <quotes></quotes>) extracted from a document and the original document (delimited by ####), please compose an answer to the question. Ensure that the answer is accurate, has a friendly tone, and sounds helpful.####{{document}}####<quotes>- Chain-of-thought (CoT) prompting[27]- Generated knowledge prompting[37]- Least-to-most prompting[38]- Self-consistency decoding[39]- Complexity-based prompting[41]- Self-refine[42]- Tree-of-thought prompting[43]- Maieutic prompting[45]- Directional-stimulus prompting[46]- Textual inversion and embeddings[59]- Using gradient descent to search for prompts[61][62][63][64]- Prompt injection[65][66][67]</quotes>
> ```

> [!success] Output of Prompt 2
> ```
> The prompting techniques mentioned in the document include:
> 1. Chain-of-thought (CoT) prompting[27]
> 2. Generated knowledge prompting[37]
> 3. Least-to-most prompting[38]
> 4. Self-consistency decoding[39]
> 5. Complexity-based prompting[41]
> 6. Self-refine[42]
> 7. Tree-of-thought prompting[43]
> 8. Maieutic prompting[45]
> 9. Directional-stimulus prompting[46]
> 10. Textual inversion and embeddings[59]
> 11. Using gradient descent to search for prompts[61][62][63][64]
> 12. Prompt injection[65][66][67]
>
> Each of these techniques employs unique strategies to enhance or specify the interactions with large language models to produce the desired outcomes.
> ```

As you can see, simplifying and creating prompt chains is a useful prompting approach where the responses need to undergo several operations or transformations. As an exercise, feel free to design a prompt that removes the citations (e.g., [27]) from the response before sending this as a final response to the user of your application.

You can also find more examples of prompt chaining in this [documentation](https://docs.anthropic.com/claude/docs/prompt-chaining) that leverages the Claude LLM. Our example is inspired and adapted from their examples.

## [Youtube video](https://youtu.be/CKZC5RigYEc)
> [!NOTE]- **Video Transcript: Prompt Chaining**
> In this demo we're going to be using flowise AI to compose a chat flow that applies the concept of prompt chaining you need to go to flow wise and again you should be running this locally already and
>
> What we're going to do is we're going to add a new chat flow
>
> So, click on add new and you will see this blank canvas
>
> The first thing we're going to do here is we are going to need a chat llm
>
> So, same as before we're going to be using this shat llm and the one that we'll be using is the one from open ey
>
> So, I'm going to drag this right here and it's using again chat open ey you can search it here or you can find it under chat models I'm going to set my credential and then I'm going to set the model that I'm going to use
>
> So, I'm going to use the latest, because I think these are more advanced tasks that I'll be performing for this particular prom chaining example and everything else will be left as default as you recall the next component is our prompt template
>
> So, we're going to go to prompt prompts right here and we're going to use a chat prompt template this time I'm going to drag it here I'm going to put them close to each other
>
> So, this shot prompt template is asking for a system message and a human message and both of these are required, because this particular test that I'm trying to perform is a bit more complex we're going to be using both of these messages
>
> So, for our system message I'm going to paste this here this is a system message that we will be using and I'll paste all of these messages and prompt templates down below
>
> So, you have access to them what we're trying to do with this particular prompt chaining example is that we want to build this helpful assistant and the task is to help answer a question given in a document the first step is to extract codes relevant to the question from the document provided and document will be Prov provided using these delimiters these bong signs here please output the list of codes and surround them with these code tags respond with no relevant codes found if no relevant codes were found in summary what we're trying to do is we are going to give the model add document you can pick any document we're going to provide you text for that document, but you can try it with any type of document that you may have around and for this first step of this prompt chain the idea is to extract codes that'll be used ful to answer questions that users will be asking this is why we're using flowise, because we don't need to build that chat interface this is already provided for us and we can directly test our prompt chain
>
> So, I'm going to save this here and then down here I will provide the document
>
> So, document is the input and I'm also going to configure where the question is going to go
>
> So, I've pasted here my human message I'm going to expand this a bit and you can see here that I'm using the delimiters and I've just chosen this document here which you can use or you can use any document that you want and this one is just talking about some prompting techniques
>
> So, I will ask a question about these prompting techniques, but this could be again any document that you have lying around and then finally here at the bottom we have this question and we have this special variable here that we're using
>
> So, as part of flowise what we can do is we can pass information as part of these prompt templates and this particular one will be identifi ifed by flow wise as some special variable and you may be asking what goes into this variable well since this is a human message what we want to pass here is the actual question that the user is asking
>
> So, I need to make that connection and the actual question that the user is asking is the question that would go right here
>
> So, this question that the user will type, but I just need to tie it up into this template
>
> So, the way you do that is you go to format prompt values down here and then you can see here that it says user question
>
> So, you can see it was populated for you if it's not you need to create it yourself you can just go in this plus button
>
> So, I will do that, because sometimes FL does that
>
> So, I'm going to cancel this one and I'm going to create that one okay go to the plus button and then add this key name
>
> Now, use your question and then it's not for no, but I need to give it a value
>
> So, I'm going to give it a value and I'm going to pass the question
>
> So, it's already there right
>
> So, I just can select that variable right away
>
> So, this is the user's question from the chop box which I just showed you I can select that and that ties in those pieces of information and
>
> Now, the prompt template has access to whatever question I'm asking through the chat
>
> So, that saves automatically I can double check it's right there and again this user question right here you can give it whatever name you want make it something that is representative, but you can give it what ever name you want and then finally to complete this first part of this prompt chain what I can do is I can use the llm chain I'm going to go to chains and I have this llm chain here I'm just drag it here and then this is asking me for a language model I will connect my language model here and I will connect my shat prompt template I can connect that right there and
>
> Now, I can save this and I'm going to save this as PR chaining example you can give it whatever name you want all right
>
> So, that's save
>
> Now, I can test I can also give this chain name a name just to make it again very easy to understand I'm going to call this extraction, because it is extracting quotes that will help answer that user question I'll save that I can go to chat
>
> Now, and I can ask a question
>
> So, the question the user is going to ask based on those documents is something like this what are the prompting techniques mentioned in the document there are some prompting techniques mentioned here
>
> So, it should be able to collect them I can hit enter as you can see here that the model responds with the prompty methods mentioned in the document and it's only mentioning those prompting methods which is nice, because that is exactly what it should do and that is what we task them all to do okay one thing you don't see here is these codes these code tags it turns out that with flow eyes it doesn't show it, because when it's displaying the message here it does some reformatting
>
> So, it doesn't show the raw code tags, but if you check in your terminal you also get the logs and you will see that it shows the codes there in the log itself
>
> So, that's pretty neat you can always look at the logs and it will show you the raw output
>
> So, I know it's there it's just not displaying here
>
> So, once we have that first part then the second part of this prompt chain is going to take the extracted outputs of this first chain which is this result here and then prepare a nice response to the user this is not really helpful as a response to the user it's not very user friendly
>
> So, we want to refine the output that we're getting from this first chain of this prompt chain
>
> So,
>
> Now, we're going to do that and this is why I was saying prompt chaining is very useful for customizing and personalizing those responses because
>
> Now, you're separating these different task you're splitting the task and you're paying closer attention to how the final output are going to look that's the benefit that you get all right
>
> So, I'm going to clone this just to make it a lot easier here I'm going to clone you have that clone option and then I'm going to clone this one, because I need another chain here and once I've done that then pay very close attention to what I'm going to do here
>
> So, this llm chain has llm chain as the output, but it also has an output prediction as the output, because I was initially using this first chain as the final output I needed to set that as llm chain
>
> So, in order for this to be a first component of this entire chat flow I will need to convert this to an upper prediction and
>
> Basically, what I'm telling it is that I will connect it to another llm chain which is going to be the second one that I'm designing
>
> So, I'm going to make that connection one time here you can see I made that connection and what I'm going to do is I'm going to connect this one to prom okay and then I'm going to connect this model here to the LM chain since I'm using the same model for both these parts then I could just connect it like this, but I could also if I wanted which makes a lot of sense in a lot of applications I could just use another model here I don't have to use this model I could use a different model especially, because this last part is going to be about refining the response to the user
>
> So, I don't really need to use a very Advanced model for that I could use a very simple model I'm going to keep the example simple I'm just going to use one model, because I really want to focus on the concept itself
>
> So, the L chain here the second one here I'm going to name this response okay I'm going to save that and then here I need to edit this
>
> So, I've cloned it
>
> So, it's giving me the same system message and the same human message, but I need to change this part and
>
> So, what we're trying to do here is we're trying to take the information that we got from that first step this entire thing and we need to prepare a response for the user
>
> So, here is the system message that I'm going to use here I'm going to delete this one and I'm going to paste this is the one that I'm going to use for the second part which is going to prepare the final response for the user
>
> So, given a set of relevant codes delimited by codes this is the answer that I got from the first step extracted from a document and the original documents delimited by this
>
> So, this is assuming that I will pass the original document as well just in case the model needs that additional context right please compose an answer to the question
>
> So, this will be the final answer ensure that the answer is short accurate has a friendly tone and sounds helpful
>
> So, we're trying to refine that answer and if you notice this particular system message is tasking the model with a couple of things right it's asking the model to compose an answer then it's asking it to make it short accurate has a friendly tone sounds helpful that might look very simple, but that's actually something that's very challenging for the model to complete, but, because we have
>
> Now, separated these two task of extraction and preparing a final response it becomes a lot easier for the model you could even go farther and divide this into simpler subtask, but I'm going to keep it as is, because I just want to focus on giving you a simple example of how to apply this promp chaining technique and I think the example that I have here is good enough
>
> So, I'm going to save this and then I need to change my human message well I have the original document here I'm just going to leave it there, but I need to change this
>
> So, this second part here I need to provide it the extracted codes that come from that first chain that first chain in that prompt chain that I'm building
>
> So, I'm going to save it and then I will explain to you what this is save that
>
> Basically, what I want are these codes I want this information to be the codes extracted codes
>
> So, so the way I will do that is I need to make that connection and
>
> So, the way we make that connection is by going here format prompt values and I need to erase this and then I need to add my key name and the key name needs to correspond to that key name I'm using the human message which is extracted codes and then I will fill this in and notice it's giving me extraction here okay
>
> So, extraction what is this this is saying that it's an OP prediction from an llm chain which is this one here
>
> So, I'll select that and
>
> Basically, what I've done with this step is I'm am
>
> Now, passing the response or the result from this first chain which is all of those codes with the code tags included, because that is what this particular prompt template is expecting
>
> So, I'll save that and that's
>
> Basically, completes the prompt chain here
>
> So, I have two parts the extraction and the final response and that completes my prompt chain example
>
> So,
>
> Now, I can test it can go here I'm going to delete this one and then I will ask it again
>
> So, this is just good practice just to make sure that everything is going well and I can go here and
>
> Now, I can ask it a question
>
> So,
>
> Now, when I ask the question the user question will go through this first chain do the extraction of the codes and then the codes will be passed to this chat prompt template and then it will try to finalize a response for me
>
> So, all of that you don't really see in the chat interface what you get is a final response which is the response that the user will see the user doesn't need to see all of the steps here that's more for you and here we go
>
> So, this is the response that we're getting it says what are the prompting techniques mentioned in the document that's the question from the user and then the response that we get here the final response to maximize the performance of llms you can use Advanced prompting techniques such as these ones these strategies help improve the quality accuracy and complexity of llm outputs you may think well this response doesn't look that great and you can keep refining that that's the beautiful thing about this
>
> Now, you can just focus on refining that response that you're getting by just focusing on this particular part which is in charge of the finite response as opposed to having to refine this as well
>
> So, this really simplifies how you iterate on prompts and this is why prompt chaining is a very important concept we will be applying this concept of promp chaining again please make sure that you're able to reproduce the example here, because I think that practice will give you more intuition into what promp chaining is and why it's
>
> So, powerful

---
# Tree of Thoughts (ToT)

For complex tasks that require exploration or strategic lookahead, traditional or simple prompting techniques fall short. [Yao et el. (2023)](https://arxiv.org/abs/2305.10601) and [Long (2023)](https://arxiv.org/abs/2305.08291) recently proposed Tree of Thoughts (ToT), a framework that generalizes over chain-of-thought prompting and encourages exploration over thoughts that serve as intermediate steps for general problem solving with language models.

ToT maintains a tree of thoughts, where thoughts represent coherent language sequences that serve as intermediate steps toward solving a problem. This approach enables an LM to self-evaluate the progress through intermediate thoughts made towards solving a problem through a deliberate reasoning process. The LM's ability to generate and evaluate thoughts is then combined with search algorithms (e.g., breadth-first search and depth-first search) to enable systematic exploration of thoughts with lookahead and backtracking.

The ToT framework is illustrated below:

![TOT](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FTOT.3b13bc5e.png&w=3840&q=75)

Image Source: [Yao et el. (2023)](https://arxiv.org/abs/2305.10601)

When using ToT, different tasks requires defining the number of candidates and the number of thoughts/steps. For instance, as demonstrated in the paper, Game of 24 is used as a mathematical reasoning task which requires decomposing the thoughts into 3 steps, each involving an intermediate equation. At each step, the best b=5 candidates are kept.

To perform BFS in ToT for the Game of 24 task, the LM is prompted to evaluate each thought candidate as "sure/maybe/impossible" with regard to reaching 24. As stated by the authors, "the aim is to promote correct partial solutions that can be verdicted within few lookahead trials, and eliminate impossible partial solutions based on "too big/small" commonsense, and keep the rest "maybe"". Values are sampled 3 times for each thought. The process is illustrated below:

![TOT2](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FTOT2.9eb8f0f9.png&w=1920&q=75)

Image Source: [Yao et el. (2023)](https://arxiv.org/abs/2305.10601)

From the results reported in the figure below, ToT substantially outperforms the other prompting methods:

![TOT3](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FTOT3.bf83699e.png&w=1920&q=75)

Image Source: [Yao et el. (2023)](https://arxiv.org/abs/2305.10601)

Code available [here](https://github.com/princeton-nlp/tree-of-thought-llm) and [here](https://github.com/jieyilong/tree-of-thought-puzzle-solver)

At a high level, the main ideas of [Yao et el. (2023)](https://arxiv.org/abs/2305.10601) and [Long (2023)](https://arxiv.org/abs/2305.08291) are similar. Both enhance LLM's capability for complex problem solving through tree search via a multi-round conversation. One of the main difference is that [Yao et el. (2023)](https://arxiv.org/abs/2305.10601) leverages DFS/BFS/beam search, while the tree search strategy (i.e. when to backtrack and backtracking by how many levels, etc.) proposed in [Long (2023)](https://arxiv.org/abs/2305.08291) is driven by a "ToT Controller" trained through reinforcement learning. DFS/BFS/Beam search are generic solution search strategies with no adaptation to specific problems. In comparison, a ToT Controller trained through RL might be able learn from new data set or through self-play (AlphaGo vs brute force search), and hence the RL-based ToT system can continue to evolve and learn new knowledge even with a fixed LLM.

[Hulbert (2023)](https://github.com/dave1010/tree-of-thought-prompting) has proposed Tree-of-Thought Prompting, which applies the main concept from ToT frameworks as a simple prompting technique, getting the LLM to evaluate intermediate thoughts in a single prompt. A sample ToT prompt is:

```
> [!example] Prompt
>
```

[Sun (2023)](https://github.com/holarissun/PanelGPT) benchmarked the Tree-of-Thought Prompting with large-scale experiments, and introduce PanelGPT --- an idea of prompting with Panel discussions among LLMs.

---
# Retrieval Augmented Generation (RAG)

General-purpose language models can be fine-tuned to achieve several common tasks such as sentiment analysis and named entity recognition. These tasks generally don't require additional background knowledge.

For more complex and knowledge-intensive tasks, it's possible to build a language model-based system that accesses external knowledge sources to complete tasks. This enables more factual consistency, improves reliability of the generated responses, and helps to mitigate the problem of "hallucination".

Meta AI researchers introduced a method called [Retrieval Augmented Generation (RAG)](https://ai.facebook.com/blog/retrieval-augmented-generation-streamlining-the-creation-of-intelligent-natural-language-processing-models/) to address such knowledge-intensive tasks. RAG combines an information retrieval component with a text generator model. RAG can be fine-tuned and its internal knowledge can be modified in an efficient manner and without needing retraining of the entire model.

RAG takes an input and retrieves a set of relevant/supporting documents given a source (e.g., Wikipedia). The documents are concatenated as context with the original input prompt and fed to the text generator which produces the final output. This makes RAG adaptive for situations where facts could evolve over time. This is very useful as LLMs's parametric knowledge is static. RAG allows language models to bypass retraining, enabling access to the latest information for generating reliable outputs via retrieval-based generation.

Lewis et al., (2021) proposed a general-purpose fine-tuning recipe for RAG. A pre-trained seq2seq model is used as the parametric memory and a dense vector index of Wikipedia is used as non-parametric memory (accessed using a neural pre-trained retriever). Below is a overview of how the approach works:

![RAG](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Frag.c6528d99.png&w=1920&q=75)

Image Source: [Lewis et el. (2021)](https://arxiv.org/pdf/2005.11401.pdf)

RAG performs strong on several benchmarks such as [Natural Questions](https://ai.google.com/research/NaturalQuestions), [WebQuestions](https://paperswithcode.com/dataset/webquestions), and CuratedTrec. RAG generates responses that are more factual, specific, and diverse when tested on MS-MARCO and Jeopardy questions. RAG also improves results on FEVER fact verification.

This shows the potential of RAG as a viable option for enhancing outputs of language models in knowledge-intensive tasks.

More recently, these retriever-based approaches have become more popular and are combined with popular LLMs like ChatGPT to improve capabilities and factual consistency.

## RAG Use Case: Generating Friendly ML Paper Titles[](https://www.promptingguide.ai/techniques/rag#rag-use-case-generating-friendly-ml-paper-titles)

Below, we have prepared a notebook tutorial showcasing the use of open-source LLMs to build a RAG system for generating short and concise machine learning paper titles:

[Getting Started with RAG](https://github.com/dair-ai/Prompt-Engineering-Guide/blob/main/notebooks/pe-rag.ipynb)

---

# Automatic Reasoning and Tool-use (ART)

Combining CoT prompting and tools in an interleaved manner has shown to be a strong and robust approach to address many tasks with LLMs. These approaches typically require hand-crafting task-specific demonstrations and carefully scripted interleaving of model generations with tool use. [Paranjape et al., (2023)](https://arxiv.org/abs/2303.09014) propose a new framework that uses a frozen LLM to automatically generate intermediate reasoning steps as a program.

ART works as follows:

- given a new task, it select demonstrations of multi-step reasoning and tool use from a task library
- at test time, it pauses generation whenever external tools are called, and integrate their output before resuming generation

ART encourages the model to generalize from demonstrations to decompose a new task and use tools in appropriate places, in a zero-shot fashion. In addition, ART is extensible as it also enables humans to fix mistakes in the reasoning steps or add new tools by simply updating the task and tool libraries. The process is demonstrated below:

![ART](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FART.3b30f615.png&w=1200&q=75)

Image Source: [Paranjape et al., (2023)](https://arxiv.org/abs/2303.09014)

ART substantially improves over few-shot prompting and automatic CoT on unseen tasks in the BigBench and MMLU benchmarks, and exceeds performance of hand-crafted CoT prompts when human feedback is incorporated.

Below is a table demonstrating ART's performance on BigBench and MMLU tasks:

![ART2](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FART2.9fb2b217.png&w=1920&q=75)

Image Source: [Paranjape et al., (2023)](https://arxiv.org/abs/2303.09014)

---

# Automatic Prompt Engineer (APE)

![APE](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FAPE.3f0e01c2.png&w=1920&q=75)

Image Source: [Zhou et al., (2022)](https://arxiv.org/abs/2211.01910)

[Zhou et al., (2022)](https://arxiv.org/abs/2211.01910) propose automatic prompt engineer (APE) a framework for automatic instruction generation and selection. The instruction generation problem is framed as natural language synthesis addressed as a black-box optimization problem using LLMs to generate and search over candidate solutions.

The first step involves a large language model (as an inference model) that is given output demonstrations to generate instruction candidates for a task. These candidate solutions will guide the search procedure. The instructions are executed using a target model, and then the most appropriate instruction is selected based on computed evaluation scores.

APE discovers a better zero-shot CoT prompt than the human engineered "Let's think step by step" prompt ([Kojima et al., 2022](https://arxiv.org/abs/2205.11916)).

The prompt "Let's work this out in a step by step way to be sure we have the right answer." elicits chain-of-thought reasoning and improves performance on the MultiArith and GSM8K benchmarks:

![APECOT](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fape-zero-shot-cot.75c0f75c.png&w=1920&q=75)

Image Source: [Zhou et al., (2022)](https://arxiv.org/abs/2211.01910)

This paper touches on an important topic related to prompt engineering which is the idea of automatically optimizing prompts. While we don't go deep into this topic in this guide, here are a few key papers if you are interested in the topic:

- [Prompt-OIRL](https://arxiv.org/abs/2309.06553) - proposes to use offline inverse reinforcement learning to generate query-dependent prompts.
- [OPRO](https://arxiv.org/abs/2309.03409) - introduces the idea of using LLMs to optimize prompts: let LLMs "Take a deep breath" improves the performance on math problems.
- [AutoPrompt](https://arxiv.org/abs/2010.15980) - proposes an approach to automatically create prompts for a diverse set of tasks based on gradient-guided search.
- [Prefix Tuning](https://arxiv.org/abs/2101.00190) - a lightweight alternative to fine-tuning that prepends a trainable continuous prefix for NLG tasks.
- [Prompt Tuning](https://arxiv.org/abs/2104.08691) - proposes a mechanism for learning soft prompts through backpropagation.
---
# Active-Prompt

Chain-of-thought (CoT) methods rely on a fixed set of human-annotated exemplars. The problem with this is that the exemplars might not be the most effective examples for the different tasks. To address this, [Diao et al., (2023)](https://arxiv.org/pdf/2302.12246.pdf) recently proposed a new prompting approach called Active-Prompt to adapt LLMs to different task-specific example prompts (annotated with human-designed CoT reasoning).

Below is an illustration of the approach. The first step is to query the LLM with or without a few CoT examples. _k_ possible answers are generated for a set of training questions. An uncertainty metric is calculated based on the _k_ answers (disagreement used). The most uncertain questions are selected for annotation by humans. The new annotated exemplars are then used to infer each question.

![ACTIVE](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Factive-prompt.f739657b.png&w=3840&q=75)

Image Source: [Diao et al., (2023)](https://arxiv.org/pdf/2302.12246.pdf)

---
# Directional Stimulus Prompting

[Li et al., (2023)](https://arxiv.org/abs/2302.11520) proposes a new prompting technique to better guide the LLM in generating the desired summary.

A tuneable policy LM is trained to generate the stimulus/hint. Seeing more use of RL to optimize LLMs.

The figure below shows how Directional Stimulus Prompting compares with standard prompting. The policy LM can be small and optimized to generate the hints that guide a black-box frozen LLM.

![DSP](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fdsp.27a0005f.jpeg&w=3840&q=75)

Image Source: [Li et al., (2023)](https://arxiv.org/abs/2302.11520)

Full example coming soon!

---

# PAL (Program-Aided Language Models)

[Gao et al., (2022)](https://arxiv.org/abs/2211.10435) presents a method that uses LLMs to read natural language problems and generate programs as the intermediate reasoning steps. Coined, program-aided language models (PAL), it differs from chain-of-thought prompting in that instead of using free-form text to obtain solution it offloads the solution step to a programmatic runtime such as a Python interpreter.

![PAL](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fpal.dfc96526.png&w=1920&q=75)

Image Source: [Gao et al., (2022)](https://arxiv.org/abs/2211.10435)

Let's look at an example using LangChain and OpenAI GPT-3. We are interested to develop a simple application that's able to interpret the question being asked and provide an answer by leveraging the Python interpreter.

Specifically, we are interested to create a functionality that allows the use of the LLM to answer questions that require date understanding. We will provide the LLM a prompt that includes a few exemplars which are adopted from [here](https://github.com/reasoning-machines/pal/blob/main/pal/prompt/date_understanding_prompt.py).

These are the imports we need:

```
import openaifrom datetime import datetimefrom dateutil.relativedelta import relativedeltaimport osfrom langchain.llms import OpenAIfrom dotenv import load_dotenv
```

Let's first configure a few things:

```
load_dotenv() # API configurationopenai.api_key = os.getenv("OPENAI_API_KEY") # for LangChainos.environ["OPENAI_API_KEY"] = os.getenv("OPENAI_API_KEY")
```

Setup model instance:

```
llm = OpenAI(model_name='text-davinci-003', temperature=0)
```

Setup prompt + question:

```
question = "Today is 27 February 2023. I was born exactly 25 years ago. What is the date I was born in MM/DD/YYYY?" DATE_UNDERSTANDING_PROMPT = """# Q: 2015 is coming in 36 hours. What is the date one week from today in MM/DD/YYYY?# If 2015 is coming in 36 hours, then today is 36 hours before.today = datetime(2015, 1, 1) - relativedelta(hours=36)# One week from today,one_week_from_today = today + relativedelta(weeks=1)# The answer formatted with %m/%d/%Y isone_week_from_today.strftime('%m/%d/%Y')# Q: The first day of 2019 is a Tuesday, and today is the first Monday of 2019. What is the date today in MM/DD/YYYY?# If the first day of 2019 is a Tuesday, and today is the first Monday of 2019, then today is 6 days later.today = datetime(2019, 1, 1) + relativedelta(days=6)# The answer formatted with %m/%d/%Y istoday.strftime('%m/%d/%Y')# Q: The concert was scheduled to be on 06/01/1943, but was delayed by one day to today. What is the date 10 days ago in MM/DD/YYYY?# If the concert was scheduled to be on 06/01/1943, but was delayed by one day to today, then today is one day later.today = datetime(1943, 6, 1) + relativedelta(days=1)# 10 days ago,ten_days_ago = today - relativedelta(days=10)# The answer formatted with %m/%d/%Y isten_days_ago.strftime('%m/%d/%Y')# Q: It is 4/19/1969 today. What is the date 24 hours later in MM/DD/YYYY?# It is 4/19/1969 today.today = datetime(1969, 4, 19)# 24 hours later,later = today + relativedelta(hours=24)# The answer formatted with %m/%d/%Y istoday.strftime('%m/%d/%Y')# Q: Jane thought today is 3/11/2002, but today is in fact Mar 12, which is 1 day later. What is the date 24 hours later in MM/DD/YYYY?# If Jane thought today is 3/11/2002, but today is in fact Mar 12, then today is 3/12/2002.today = datetime(2002, 3, 12)# 24 hours later,later = today + relativedelta(hours=24)# The answer formatted with %m/%d/%Y islater.strftime('%m/%d/%Y')# Q: Jane was born on the last day of Feburary in 2001. Today is her 16-year-old birthday. What is the date yesterday in MM/DD/YYYY?# If Jane was born on the last day of Feburary in 2001 and today is her 16-year-old birthday, then today is 16 years later.today = datetime(2001, 2, 28) + relativedelta(years=16)# Yesterday,yesterday = today - relativedelta(days=1)# The answer formatted with %m/%d/%Y isyesterday.strftime('%m/%d/%Y')# Q: {question}""".strip() + '\n'
```

```
llm_out = llm(DATE_UNDERSTANDING_PROMPT.format(question=question))print(llm_out)
```

This will output the following:

> [!success] Output
> ```python
> # If today is 27 February 2023 and I was born exactly 25 years ago, then I was born 25 years before.
> today = datetime(2023, 2, 27)
> # I was born 25 years before,
> born = today - relativedelta(years=25)
> # The answer formatted with %m/%d/%Y is
> born.strftime('%m/%d/%Y')
> ```

The contents of `llm_out` are a Python code snippet. Below, the `exec` command is used to execute this Python code snippet.

```
exec(llm_out)print(born)
```

This will output the following: `02/27/1998`

---
# ReAct Prompting

[Yao et al., 2022](https://arxiv.org/abs/2210.03629) introduced a framework named ReAct where LLMs are used to generate both _reasoning traces_ and _task-specific actions_ in an interleaved manner.

Generating reasoning traces allow the model to induce, track, and update action plans, and even handle exceptions. The action step allows to interface with and gather information from external sources such as knowledge bases or environments.

The ReAct framework can allow LLMs to interact with external tools to retrieve additional information that leads to more reliable and factual responses.

Results show that ReAct can outperform several state-of-the-art baselines on language and decision-making tasks. ReAct also leads to improved human interpretability and trustworthiness of LLMs. Overall, the authors found that best approach uses ReAct combined with chain-of-thought (CoT) that allows use of both internal knowledge and external information obtained during reasoning.

## How it Works?[](https://www.promptingguide.ai/techniques/react#how-it-works)

ReAct is inspired by the synergies between "acting" and "reasoning" which allow humans to learn new tasks and make decisions or reasoning.

Chain-of-thought (CoT) prompting has shown the capabilities of LLMs to carry out reasoning traces to generate answers to questions involving arithmetic and commonsense reasoning, among other tasks [(Wei et al., 2022)](https://arxiv.org/abs/2201.11903). But its lack of access to the external world or inability to update its knowledge can lead to issues like fact hallucination and error propagation.

ReAct is a general paradigm that combines reasoning and acting with LLMs. ReAct prompts LLMs to generate verbal reasoning traces and actions for a task. This allows the system to perform dynamic reasoning to create, maintain, and adjust plans for acting while also enabling interaction to external environments (e.g., Wikipedia) to incorporate additional information into the reasoning. The figure below shows an example of ReAct and the different steps involved to perform question answering.

![REACT](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Freact.8e7c93ae.png&w=1920&q=75)

Image Source: [Yao et al., 2022](https://arxiv.org/abs/2210.03629)

In the example above, we pass a prompt like the following question from [HotpotQA](https://hotpotqa.github.io/):

> [!example] Prompt
> ```
> Aside from the Apple Remote, what other devices can control the program Apple Remote was originally designed to interact with?
> ```

Note that in-context examples are also added to the prompt but we exclude that here for simplicity. We can see that the model generates _task solving trajectories_ (Thought, Act). Obs corresponds to observation from the environment that's being interacted with (e.g., Search engine). In essence, ReAct can retrieve information to support reasoning, while reasoning helps to target what to retrieve next.

## ReAct Prompting[](https://www.promptingguide.ai/techniques/react#react-prompting)

To demonstrate how ReAct prompting works, let's follow an example from the paper.

The first step is to select cases from a training set (e.g., HotPotQA) and compose ReAct-format trajectories. These are used as few-shot exemplars in the prompts. The trajectories consist of multiple thought-action-observation steps as shown in the figure above. The free-form thoughts are used to achieve different tasks such as decomposing questions, extracting information, performing commonsense/arithmetic reasoning, guide search formulation, and synthesizing final answer.

Here is an example of what the ReAct prompt exemplars look like (obtained from the paper and shortened to one example for simplicity):

> [!example] ReAct Prompt Exemplar
> ```
> Question What is the elevation range for the area that the eastern sector of theColorado orogeny extends into?
> Thought 1 I need to search Colorado orogeny, find the area that the eastern sectorof the Colorado orogeny extends into, then find the elevation range of thearea.
> Action 1 Search[Colorado orogeny]
> Observation 1 The Colorado orogeny was an episode of mountain building (an orogeny) inColorado and surrounding areas.
> Thought 2 It does not mention the eastern sector. So I need to look up easternsector.
> Action 2 Lookup[eastern sector]
> Observation 2 (Result 1 / 1) The eastern sector extends into the High Plains and is calledthe Central Plains orogeny.
> Thought 3 The eastern sector of Colorado orogeny extends into the High Plains. So Ineed to search High Plains and find its elevation range.
> Action 3 Search[High Plains]
> Observation 3 High Plains refers to one of two distinct land regions
> Thought 4 I need to instead search High Plains (United States).
> Action 4 Search[High Plains (United States)]
> Observation 4 The High Plains are a subregion of the Great Plains. From east to west, theHigh Plains rise in elevation from around 1,800 to 7,000 ft (550 to 2,130m).[3]
> Thought 5 High Plains rise in elevation from around 1,800 to 7,000 ft, so the answeris 1,800 to 7,000 ft.
> Action 5 Finish[1,800 to 7,000 ft]
> ...
> ```

Note that different prompts setups are used for different types of tasks. For tasks where reasoning is of primary importance (e.g., HotpotQA), multiple thought-action-observation steps are used for the task-solving trajectory. For decision making tasks involving lots of action steps, thoughts are used sparsely.

## Results on Knowledge-Intensive Tasks[](https://www.promptingguide.ai/techniques/react#results-on-knowledge-intensive-tasks)

The paper first evaluates ReAct on knowledge-intensive reasoning tasks such as question answering (HotPotQA) and fact verification ([Fever](https://fever.ai/resources.html)). PaLM-540B is used as the base model for prompting.

![REACT1](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Ftable1.e25bc12b.png&w=1920&q=75)

Image Source: [Yao et al., 2022](https://arxiv.org/abs/2210.03629)

The prompting results on HotPotQA and Fever using different prompting methods show that ReAct generally performs better than Act (involves acting only) on both tasks.

We can also observe that ReAct outperforms CoT on Fever and lags behind CoT on HotpotQA. A detailed error analysis is provided in the paper. In summary:

- CoT suffers from fact hallucination
- ReAct's structural constraint reduces its flexibility in formulating reasoning steps
- ReAct depends a lot on the information it's retrieving; non-informative search results derails the model reasoning and leads to difficulty in recovering and reformulating thoughts

Prompting methods that combine and support switching between ReAct and CoT+Self-Consistency generally outperform all the other prompting methods.

## Results on Decision Making Tasks[](https://www.promptingguide.ai/techniques/react#results-on-decision-making-tasks)

The paper also reports results demonstrating ReAct's performance on decision making tasks. ReAct is evaluated on two benchmarks called [ALFWorld](https://alfworld.github.io/) (text-based game) and [WebShop](https://webshop-pnlp.github.io/) (online shopping website environment). Both involve complex environments that require reasoning to act and explore effectively.

Note that the ReAct prompts are designed differently for these tasks while still keeping the same core idea of combining reasoning and acting. Below is an example for an ALFWorld problem involving ReAct prompting.

![REACT2](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Falfworld.da30656d.png&w=1920&q=75)

Image Source: [Yao et al., 2022](https://arxiv.org/abs/2210.03629)

ReAct outperforms Act on both ALFWorld and Webshop. Act, without any thoughts, fails to correctly decompose goals into subgoals. Reasoning seems to be advantageous in ReAct for these types of tasks but current prompting-based methods are still far from the performance of expert humans on these tasks.

Check out the paper for more detailed results.

## LangChain ReAct Usage[](https://www.promptingguide.ai/techniques/react#langchain-react-usage)

Below is a high-level example of how the ReAct prompting approach works in practice. We will be using OpenAI for the LLM and [LangChain](https://python.langchain.com/en/latest/index.html) as it already has built-in functionality that leverages the ReAct framework to build agents that perform tasks by combining the power of LLMs and different tools.

First, let's install and import the necessary libraries:

```
%%capture# update or install the necessary libraries!pip install --upgrade openai!pip install --upgrade langchain!pip install --upgrade python-dotenv!pip install google-search-results # import librariesimport openaiimport osfrom langchain.llms import OpenAIfrom langchain.agents import load_toolsfrom langchain.agents import initialize_agentfrom dotenv import load_dotenvload_dotenv() # load API keys; you will need to obtain these if you haven't yetos.environ["OPENAI_API_KEY"] = os.getenv("OPENAI_API_KEY")os.environ["SERPER_API_KEY"] = os.getenv("SERPER_API_KEY")
```

Now we can configure the LLM, the tools we will use, and the agent that allows us to leverage the ReAct framework together with the LLM and tools. Note that we are using a search API for searching external information and LLM as a math tool.

```
llm = OpenAI(model_name="text-davinci-003" ,temperature=0)tools = load_tools(["google-serper", "llm-math"], llm=llm)agent = initialize_agent(tools, llm, agent="zero-shot-react-description", verbose=True)
```

Once that's configured, we can now run the agent with the desired query/prompt. Notice that here we are not expected to provide few-shot exemplars as explained in the paper.

```
agent.run("Who is Olivia Wilde's boyfriend? What is his current age raised to the 0.23 power?")
```

The chain execution looks as follows:

```
> Entering new AgentExecutor chain... I need to find out who Olivia Wilde's boyfriend is and then calculate his age raised to the 0.23 power.Action: SearchAction Input: "Olivia Wilde boyfriend"Observation: Olivia Wilde started dating Harry Styles after ending her years-long engagement to Jason Sudeikis — see their relationship timeline.Thought: I need to find out Harry Styles' age.Action: SearchAction Input: "Harry Styles age"Observation: 29 yearsThought: I need to calculate 29 raised to the 0.23 power.Action: CalculatorAction Input: 29^0.23Observation: Answer: 2.169459462491557 Thought: I now know the final answer.Final Answer: Harry Styles, Olivia Wilde's boyfriend, is 29 years old and his age raised to the 0.23 power is 2.169459462491557. > Finished chain.
```

The output we get is as follows:

```
"Harry Styles, Olivia Wilde's boyfriend, is 29 years old and his age raised to the 0.23 power is 2.169459462491557."
```

We adapted the example from the [LangChain documentation](https://python.langchain.com/docs/modules/agents/agent_types/react), so credit goes to them. We encourage the learner to explore different combination of tools and tasks.

You can find the notebook for this code here: [https://github.com/dair-ai/Prompt-Engineering-Guide/blob/main/notebooks/react.ipynb](https://github.com/dair-ai/Prompt-Engineering-Guide/blob/main/notebooks/react.ipynb)

## [Youtube video](https://youtu.be/f8whjxDBcd8)
in this demonstration we're going to use flse to create our first basic react agent inside of flowes you will choose chop flows then you will choose add new then you will start off with a blank canvas okay so now what we can do here is we can start off with our language model so we need a language model this is going to help power this agent capabilities such as planning and reasoning and we're going to use chat open AI so here we have chat open Ai and you should have already set up your credentials so we have a video about that as well in the previous section where we introduced LCI and you will take that credential and you're going to set it up here so I'm going to choose my credential here because I already have it stored and then for this I'm going to use the GPD 40 mini which is the one of the latest models from openi and I need to use one of the latest models because I want to use the model that has really good reasoning capabilities but you can experiment with any of these models or different providers as well so we have this model here and then what we need is we need our react agent so instead of flow wise because it's built on top of Lang chain we have the ability to use Lang Chain's react agent functionality so if we go under agents right here you will see that there are several types of agents that have been built in into the FL I tool and so the one that we're going to use is this react agent for chat models so agent that uses the react logic to decide what action to take optimize to be used with chat models so I'm just going to drag this here and so now we have two of the core components that makes this react agent so what I need to do is I need to connect this now and we have our chat model right here and then we're missing two components here we discuss the ability of the react agent to use these external tools so we can connect an external tool right here so we can use for instance something like a calculator as a very basic example here so I'm going to go here and you will see that there's also a tool section so here's a tool section and under Tools we have this calculator tool so I can go and drag that here and now we have a calculator tool it's not asking me to do anything special it's just a calculator but I can now connect that to allow tools so I can continue to add more tools if I want but for this demonstration I'm going to keep it very basic in future use cases and demonstrations we're going to be using all kinds of very complex tools such as search engines and so forth then the last component here is memory so I'm going to take a memory component from here so if we go to the list here we have memory and under memory we have different kinds of memory components one type of memory component that we can use here is this buffer memory and what does it do it retrieve chat messages stored in a database so basically it's going to allow the react agent to use its chat history if it needs to access whatever information it had pulled already from the external tool so I'm just going to drag it here and then I'm just going to connect it right here we have our memory component we have our chat model and we have our calculator so that's it we have developed a very basic react agent and now we can save this so I'm going to go here to this button I'm going to save and I'm going to give it a name I'm going to call this basic react I'm going to save this and the cool thing about flowise is that I can very quickly test this idea so we have this chat feature here that I can go and open and then I can start to interact with my agent so I can type a question like how much is 98,000 times I'm giving it a m problem here I want agent to actually use the calculator because that is what it has access to I'm just going to ask you this question for problems like this you really don't want to trust a language model to do Tas like this so it's going to be very useful for the agent to access this calculator and it's going to see it it's going to see oh I have a sort of mat problem here and it's going to decide okay I need to take these two different numbers and I need to give and provide that to the calculator as some type of input and then the calculator is going to respond back with the result and then it's going to have the result and then the language mod will compose a final answer for us that's sort of what the process is here so you can see here it says 98,000 * 150,000 is this huge number here so again for calculations like this we really want to use like a calculator tool to do this so this is the first example of a basic react agent with OP the different components that we discussed in this module and in upcoming modules we are going to build on top of this idea and build more complex agentic systems that are going to leverage complex tools and leverage this idea of the ability of an agent to use memory to use different tools and use a very powerful large language model to complete very complex tasks

---
# Reflexion

Reflexion is a framework to reinforce language-based agents through linguistic feedback. According to [Shinn et al. (2023)](https://arxiv.org/pdf/2303.11366.pdf), "Reflexion is a new paradigm for ‘verbal‘ reinforcement that parameterizes a policy as an agent’s memory encoding paired with a choice of LLM parameters."

At a high level, Reflexion converts feedback (either free-form language or scalar) from the environment into linguistic feedback, also referred to as **self-reflection**, which is provided as context for an LLM agent in the next episode. This helps the agent rapidly and effectively learn from prior mistakes leading to performance improvements on many advanced tasks.

!["Reflexion Framework"](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Freflexion.1053729e.png&w=1920&q=75)

As shown in the figure above, Reflexion consists of three distinct models:

- **An Actor**: Generates text and actions based on the state observations. The Actor takes an action in an environment and receives an observation which results in a trajectory. [Chain-of-Thought (CoT)](https://www.promptingguide.ai/techniques/cot) and [ReAct](https://www.promptingguide.ai/techniques/react) are used as Actor models. A memory component is also added to provide additional context to the agent.
- **An Evaluator**: Scores outputs produced by the Actor. Concretely, it takes as input a generated trajectory (also denoted as short-term memory) and outputs a reward score. Different reward functions are used depending on the task (LLMs and rule-based heuristics are used for decision-making tasks).
- **Self-Reflection**: Generates verbal reinforcement cues to assist the Actor in self-improvement. This role is achieved by an LLM and provides valuable feedback for future trials. To generate specific and relevant feedback, which is also stored in memory, the self-reflection model makes use of the reward signal, the current trajectory, and its persistent memory. These experiences (stored in long-term memory) are leveraged by the agent to rapidly improve decision-making.

In summary, the key steps of the Reflexion process are a) define a task, b) generate a trajectory, c) evaluate, d) perform reflection, and e) generate the next trajectory. The figure below demonstrates examples of how a Reflexion agent can learn to iteratively optimize its behavior to solve various tasks such as decision-making, programming, and reasoning. Reflexion extends the ReAct framework by introducing self-evaluation, self-reflection and memory components.

!["Reflexion Examples"](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Freflexion-examples.7558c279.png&w=3840&q=75)

## Results[](https://www.promptingguide.ai/techniques/reflexion#results)

Experimental results demonstrate that Reflexion agents significantly improve performance on decision-making AlfWorld tasks, reasoning questions in HotPotQA, and Python programming tasks on HumanEval.

When evaluated on sequential decision-making (AlfWorld) tasks, ReAct + Reflexion significantly outperforms ReAct by completing 130/134 tasks using self-evaluation techniques of Heuristic and GPT for binary classification.

!["Reflexion ALFWorld Results"](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Freflexion-alfworld.54c4ce9c.png&w=3840&q=75)

Reflexion significantly outperforms all baseline approaches over several learning steps. For reasoning only and when adding an episodic memory consisting of the most recent trajectory, Reflexion + CoT outperforms CoT only and CoT with episodic memory, respectively.

!["Reflexion ALFWorld Results"](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Freflexion-hotpotqa.2753b155.png&w=1920&q=75)

As summarized in the table below, Reflexion generally outperforms the previous state-of-the-art approaches on Python and Rust code writing on MBPP, HumanEval, and Leetcode Hard.

!["Reflexion ALFWorld Results"](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Freflexion-programming.56effd6a.png&w=1920&q=75)

## When to Use Reflexion?[](https://www.promptingguide.ai/techniques/reflexion#when-to-use-reflexion)

Reflexion is best suited for the following:

1. **An agent needs to learn from trial and error**: Reflexion is designed to help agents improve their performance by reflecting on past mistakes and incorporating that knowledge into future decisions. This makes it well-suited for tasks where the agent needs to learn through trial and error, such as decision-making, reasoning, and programming.

2. **Traditional reinforcement learning methods are impractical**: Traditional reinforcement learning (RL) methods often require extensive training data and expensive model fine-tuning. Reflexion offers a lightweight alternative that doesn't require fine-tuning the underlying language model, making it more efficient in terms of data and compute resources.

3. **Nuanced feedback is required**: Reflexion utilizes verbal feedback, which can be more nuanced and specific than scalar rewards used in traditional RL. This allows the agent to better understand its mistakes and make more targeted improvements in subsequent trials.

4. **Interpretability and explicit memory are important**: Reflexion provides a more interpretable and explicit form of episodic memory compared to traditional RL methods. The agent's self-reflections are stored in its memory, allowing for easier analysis and understanding of its learning process.


Reflexion is effective in the following tasks:

- **Sequential decision-making**: Reflexion agents improve their performance in AlfWorld tasks, which involve navigating through various environments and completing multi-step objectives.
- **Reasoning**: Reflexion improved the performance of agents on HotPotQA, a question-answering dataset that requires reasoning over multiple documents.
- **Programming**: Reflexion agents write better code on benchmarks like HumanEval and MBPP, achieving state-of-the-art results in some cases.

Here are some limitations of Reflexion:

- **Reliance on self-evaluation capabilities**: Reflexion relies on the agent's ability to accurately evaluate its performance and generate useful self-reflections. This can be challenging, especially for complex tasks but it's expected that Reflexion gets better over time as models keep improving in capabilities.
- **Long-term memory constraints**: Reflexion makes use of a sliding window with maximum capacity but for more complex tasks it may be advantageous to use advanced structures such as vector embedding or SQL databases.
- **Code generation limitations**: There are limitations to test-driven development in specifying accurate input-output mappings (e.g., non-deterministic generator function and function outputs influenced by hardware).

---

_Figures source: [Reflexion: Language Agents with Verbal Reinforcement Learning](https://arxiv.org/pdf/2303.11366.pdf)_

## References[](https://www.promptingguide.ai/techniques/reflexion#references)

- [Reflexion: Language Agents with Verbal Reinforcement Learning](https://arxiv.org/pdf/2303.11366.pdf)
- [Can LLMs Critique and Iterate on Their Own Outputs?](https://evjang.com/2023/03/26/self-reflection.html)

---

# Multimodal CoT Prompting

[Zhang et al. (2023)](https://arxiv.org/abs/2302.00923) recently proposed a multimodal chain-of-thought prompting approach. Traditional CoT focuses on the language modality. In contrast, Multimodal CoT incorporates text and vision into a two-stage framework. The first step involves rationale generation based on multimodal information. This is followed by the second phase, answer inference, which leverages the informative generated rationales.

The multimodal CoT model (1B) outperforms GPT-3.5 on the ScienceQA benchmark.

![MCOT](https://www.promptingguide.ai/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fmultimodal-cot.a84f6cc1.png&w=1920&q=75)

Image Source: [Zhang et al. (2023)](https://arxiv.org/abs/2302.00923)

Further reading:

- [Language Is Not All You Need: Aligning Perception with Language Models](https://arxiv.org/abs/2302.14045) (Feb 2023)

---
# GraphPrompts

[Liu et al., 2023](https://arxiv.org/abs/2302.08043) introduces GraphPrompt, a new prompting framework for graphs to improve performance on downstream tasks.

More coming soon!